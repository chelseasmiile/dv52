@extends('layouts.layout')
@section('content')
<div id="ajax-content-wrap">
<div class="container-wrap" style="min-height: 183.969px;">
<div class="container main-content" role="main">
<div class="row">
    
  <h1>Generador de Códigos QR</h1>
  <div class="form-container">
    <input type="text" id="text-input" placeholder="Ingrese la descripción del artículo">
    <input type="date" id="date-input" placeholder="Fecha">
    <input type="text" id="participants-input" placeholder="Participantes">
    <button onclick="generateQRCode()">Generar código QR</button>
    
  </div>
  <div id="qrcode"></div>
  <div id="result-container"></div>
  <div class="print-button">
    <button onclick="printQRCode()" id="print-button" disabled>Imprimir código QR</button>
  </div>

  <script>
    var qrGenerated = false;

    function generateQRCode() {
      var text = document.getElementById("text-input").value;
      var date = document.getElementById("date-input").value;
      var participants = document.getElementById("participants-input").value;

      // Validar campos obligatorios
      if (text === '' || date === '' || participants === '') {
        alert('Por favor, complete todos los campos.');
        return;
      }

      var qrData = {
        Descripcion: text,
        Fecha: date,
        Participantes: participants
      };

      var qrText = JSON.stringify(qrData);

      var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: qrText,
        width: 128,
        height: 128
      });

      // Limpiar el contenido anterior
      var resultContainer = document.getElementById("result-container");
      resultContainer.innerHTML = "";

      // Crear elementos para mostrar los datos del código QR
      var qrDataObject = JSON.parse(qrText);
      for (var key in qrDataObject) {
        var label = document.createElement("p");
        label.innerText = key + ":";
        resultContainer.appendChild(label);

        var value = document.createElement("p");
        value.innerText = qrDataObject[key];
        resultContainer.appendChild(value);
      }

      qrGenerated = true;
      document.getElementById("print-button").disabled = false;
    }

    function printQRCode() {
      if (!qrGenerated) {
        alert("Primero debe generar un código QR.");
        return;
      }

      var qrcodeDiv = document.getElementById("qrcode");
      var printWindow = window.open('', '_blank', 'width=600,height=600');
      printWindow.document.open();
      printWindow.document.write('<html><head><title>Código QR</title></head><body>');
      printWindow.document.write(qrcodeDiv.innerHTML);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
    }
  </script>
   
</div>
</div>
</div>
@endsection