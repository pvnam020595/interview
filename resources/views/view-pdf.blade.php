<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modify PDF</title>
    <script src="{{ url('/node_modules/pdf-lib/dist/pdf-lib.min.js') }}"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="alert alert-primary" role="alert" id="messages" style="display: none">
    
    </div>
      <form action="" method="post" enctype="multipart/form-data" id="laravel-ajax-file-upload">
          @csrf
          <label for="">Upload file PDF</label>
          <input type="file" name="file_pdf" id="file_pdf" value="" onchange="uploadPdf()"/>
          <input type="text" name="pdf" id="pdf" value="" hidden />
          <input type="text" name="bar-code" id="bar-code" value="{{ url('/public/files/bar-code.jpg') }}" hidden />
        </form>
        <button class="btn-primary btn" id="btn-modify" onclick="modifyPdf()" style="display: none">Modify PDF</button>
  </div>
</body>

</html>
<script>
    const {
        degrees,
        PDFDocument,
        rgb,
        StandardFonts,
        grayscale
    } = PDFLib
    function uploadPdf() {
      var formdata = new FormData();
      var files = $('#file_pdf')[0].files;
      if(files.length > 0)
      {
          formdata.append("file_pdf", files[0]);
        }
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url('/uploadpdf') }}",
        data : formdata,
        type : 'post',
        dataType : 'json',
        contentType: false,
        processData: false,
        success : function(result){

          $('#messages').html(result.messages)
          if(result.success == true) {
            $('#btn-modify, #messages').show();
            $('#pdf').val(result.data);
          }
        }
      });
    }
    async function modifyPdf() {
        // Fetch an existing PDF document
        // const jpgUrl = 'https://pdf-lib.js.org/assets/cat_riding_unicorn.jpg'
        const url = document.getElementById('pdf').value;
        const barcode = document.getElementById('bar-code').value;
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())
        const jpgImageBytes = await fetch(barcode).then(res => res.arrayBuffer())
        // Load a PDFDocument from the existing PDF bytes
        const pdfDoc = await PDFDocument.load(existingPdfBytes)
        const jpgImage = await pdfDoc.embedJpg(jpgImageBytes)
        // Embed the Helvetica font
        const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)

        // Get the first page of the document
        const pages = pdfDoc.getPages()
        const firstPage = pages[0]
        const text_left_right =
            'Hardcover Port/Matte W ES 390 X 290 Matte Page EPCZ 390X290 (15.360x11.420) #=FB14B9GA0G'
        // Get the width and height of the first page
        const {
            width,
            height
        } = firstPage.getSize()
        // Draw a string of text diagonally across the first page
        firstPage.drawText('P6480', {
            x: 5,
            y: height - 100,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00, 0.00, 0.00),
            rotate: degrees(-90),
        })
        firstPage.drawText(`${text_left_right}`, {
            x: 5,
            y: height - 160,
            size: 14,
            font: helveticaFont,
            rotate: degrees(-90),
        })

        firstPage.drawText(`${text_left_right}`, {
            x: width,
            y: height / 2 - 240,
            size: 14,
            font: helveticaFont,
            rotate: degrees(90),
        })

        firstPage.drawText('P6480', {
            x: width,
            y: height / 2 - 300,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00, 0.00, 0.00),
            rotate: degrees(90),
        })
        const jpgDims = jpgImage.scale(0.02)
        firstPage.drawImage(jpgImage, {
            x: width / 4 - jpgDims.width / 2,
            y: height - jpgDims.height + 10,
            width: 300,
            height: jpgDims.height - 10,
        })
        firstPage.drawText('P6480', {
            x: width / 5 - jpgDims.width,
            y: height - (jpgDims.height - 10),
            size: 14,
            font: helveticaFont,
            color: rgb(1.00, 0.00, 0.00),
            // rotate: degrees(90),
        })
        firstPage.drawText('PM474730-1', {
            x: width / 5 + jpgDims.width,
            y: height - (jpgDims.height - 10),
            size: 14,
            font: helveticaFont,
            // color: rgb(1.00,0.00,0.00),
            // rotate: degrees(90),
        })
        firstPage.drawText('8 mm', {
            x: width / 3 + jpgDims.width + 50,
            y: height - (jpgDims.height - 10),
            size: 14,
            font: helveticaFont,
            color: rgb(0.00, 0.00, 1.00),
            // rotate: degrees(90),
        })

        // Bottom
        firstPage.drawImage(jpgImage, {
            x: width / 4 - jpgDims.width / 2,
            // y: jpgDims.height + 10,
            width: 300,
            height: jpgDims.height - 10,
        })

        firstPage.drawText('P6480', {
            x: width,
            y: height / 2 - 300,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00, 0.00, 0.00),
            rotate: degrees(90),
        })
        firstPage.drawText('P6480', {
            x: width / 5 - jpgDims.width,
            y: jpgDims.height / 4,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00, 0.00, 0.00),
            // rotate: degrees(90),
        })
        firstPage.drawText('PM474730-1', {
            x: width / 5 + jpgDims.width,
            y: jpgDims.height / 4,
            size: 14,
            font: helveticaFont,
            // color: rgb(1.00,0.00,0.00),
            // rotate: degrees(90),
        })
        firstPage.drawText('8 mm', {
            x: width / 3 + jpgDims.width + 50,
            y: jpgDims.height / 4,
            size: 14,
            font: helveticaFont,
            color: rgb(0.00, 0.00, 1.00),
            // rotate: degrees(90),
        })
        // Make Center
        const svgPath = 'M 90 180 L 0 180 L 90 180'

        // Change border style and opacity
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 50,
            y: 0,
            scale: 0.3,
            rotate: degrees(90),

        })
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 20,
            y: 120,
            // borderColor: rgb(1.0, 0, 0),
            borderWidth: 20,
            borderOpacity: 0.75,
            scale: 0.5,
            // rotate: degrees(90),
            borderDashPhase: 2,

        })
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 10,
            y: 85,
            borderColor: rgb(1.00, 1.00, 0.00),
            borderWidth: 20,
            borderOpacity: 0.75,
            scale: 0.3,
            // rotate: degrees(90),
            borderDashPhase: 2,

        })
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 50,
            y: height - 29,
            scale: 0.3,
            rotate: degrees(90),

        })
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 20,
            y: height + jpgDims.height + 22,
            // borderColor: rgb(1.0, 0, 0),
            borderWidth: 20,
            borderOpacity: 0.75,
            scale: 0.5,
            // rotate: degrees(90),
            borderDashPhase: 2,

        })
        firstPage.drawSvgPath(svgPath, {
            x: width / 2 - 10,
            y: height + (jpgDims.height - 14),
            borderColor: rgb(1.00, 1.00, 0.00),
            borderWidth: 20,
            borderOpacity: 0.75,
            scale: 0.3,
            // rotate: degrees(90),
            borderDashPhase: 2,

        })
        // Get the form so we can add fields to it
        const form = pdfDoc.getForm()

        const mlm1_1 = form.createTextField('weeding.mlm1_1')
        mlm1_1.setText('MLM1')
        mlm1_1.addToPage(firstPage, {
            x: width - (width / 4),
            y: height - jpgDims.height + 10,
            backgroundColor: rgb(1.00, 1.00, 0.00),
            borderWidth: 0,
            height: 30,
            width: 60
        })
        const fieldMLM1 = form.getField('weeding.mlm1_1')
        fieldMLM1.setFontSize(20)
        const mlm1_2 = form.createTextField('weeding.mlm1_2')
        mlm1_2.setText('MLM1')
        mlm1_2.addToPage(firstPage, {
            x: width - (width / 4),
            y: 10,
            backgroundColor: rgb(1.00, 1.00, 0.00),
            borderWidth: 0,
            height: 30,
            width: 60
        })
        const fields = form.getField('weeding.mlm1_2')
        fields.setFontSize(20)

        form.flatten();
        firstPage.drawText('13/07/2023', {
            x: width - (width / 4) + 80,
            y: height - jpgDims.height + 10,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00,0.12,0.44),
        })
        firstPage.drawText(' Item 1/1 QTY=1 Cover 1/1', {
            x: width - (width / 4) + 150,
            y: height - jpgDims.height + 10,
            size: 16,
            font: helveticaFont,
        })
        firstPage.drawText('S', {
            x: width - 250,
            y: height - 15,
            size: 30,
            font: helveticaFont,
            color: rgb(0, 1, 0),
        })
        firstPage.drawText('13/07/2023', {
            x: width - (width / 4) + 80,
            y: jpgDims.height / 4,
            size: 14,
            font: helveticaFont,
            color: rgb(1.00,0.12,0.44),
        })
        firstPage.drawText(' Item 1/1 QTY=1 Cover 1/1', {
            x: width - (width / 4) + 150,
            y: jpgDims.height / 4,
            size: 14,
            font: helveticaFont,
        })
        firstPage.drawText('S', {
            x: width - 250,
            y: jpgDims.height / 4,
            size: 30,
            font: helveticaFont,
            color: rgb(0, 1, 0),
        })
        // Serialize the PDFDocument to bytes (a Uint8Array)
        const pdfBytes = await pdfDoc.save()
        // Trigger the browser to download the PDF document
        // download(pdfBytes, "pdf-lib_modification_example.pdf", "application/pdf");

        const arr = new Uint8Array(pdfBytes);
        const blob = new Blob([arr], {
            type: 'application/pdf'
        });
        const modified_pdf = URL.createObjectURL(blob);
        window.open(modified_pdf);
    }
</script>


