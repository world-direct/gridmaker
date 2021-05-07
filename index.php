<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SVG Gridmaker</title>
  <meta name="author" content="Klaus Hörmann-Engl">
  <meta name="description" content="A gridmaker which generates SVG Images">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
  <link href="external/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="row align-items-center">
      <div class="col-12 col-md-4">
        <a class="navbar-brand" href="https://www.world-direct.at/" target="_blank">
          <img src="img/logo.svg" height="42" class="d-inline-block align-top" alt="World-Direct Logo with claim" loading="lazy">
        </a>
      </div>
      <div class="col-12 col-md-4 text-center h4 mt-3 mt-md-0 mb-0">SVG Gridmaker</div>
      <div class="col-12 col-md-4 text-center text-md-right text-muted mt-1 mt-md-0 mb-3 mb-md-0">Generate icons for the TYPO3 extension <a href="https://extensions.typo3.org/extension/gridelements/" target="_blank">gridelements</a>, or <a href="https://extensions.typo3.org/extension/container/" target="_blank">container</a> </div>
    </div>
  </nav>

  <div class="container">
    <form id="gridmaker-form" method="POST" action="renderer.php" target="_blank">

      <!-- Grid configuration -->
      <div class="form-row">
        <div class="col-6 mt-4">
          <label for="colTotal">Total number of columns</label>
          <input id="colTotal" name="colTotal" class="form-control" placeholder="12" required="required" value="12">
          <small class="form-text text-muted">The total amount of columns</small>
        </div>
        <div class="col-6 mt-4">
          <label for="columns">Column string</label>
          <input id="columns" name="columns" class="form-control" placeholder="5-4-2" required="required" value="6-6">
          <small class="form-text text-muted">Column count must sum up to <span id="refColTotal">12</span></small>
        </div>
      </div>

      <!-- SVG layout configuration -->
      <div class="form-row">
        <div class="col-6 col-md-3 mt-4">
          <label for="width">Width of SVG</label>
          <input id="width" name="width" type="number" class="form-control" placeholder="32" value="32">
          <small class="form-text text-muted">The width of the resulting SVG image</small>
        </div>
        <div class="col-6 col-md-3 mt-4">
          <label for="height">Height of SVG</label>
          <input id="height" name="height" type="number" class="form-control" placeholder="32" value="32">
          <small class="form-text text-muted">The height of the resulting SVG image</small>
        </div>
        <div class="col-6 col-md-3 mt-4">
          <label for="borderWidth">Border width</label>
          <input id="borderWidth" type="number" name="borderWidth" class="form-control" placeholder="1" value="1">
          <small class="form-text text-muted">The width of the border</small>
        </div>
        <div class="col-6 col-md-3 mt-4">
          <label for="canvasPadding">Canvas padding</label>
          <input id="canvasPadding" type="number" name="canvasPadding" class="form-control" placeholder="1" value="2">
          <small class="form-text text-muted">Padding of canvas which holds columns</small>
        </div>
      </div>

      <!-- SVG colors -->
      <div class="form-row">
        <div class="col-4 col-md-3 mt-4">
          <label for="borderColor">Border color</label>
          <div id="borderColorField" class="input-group colorpicker-component">
            <input type="text" id="borderColor" name="borderColor" value="#000000" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text"><i></i></span>
            </div>
          </div>
          <small class="form-text text-muted">The color for the border</small>
        </div>
        <div class="col-4 col-md-3 mt-4">
          <label for="canvasColor">Canvas color</label>
          <div id="canvasColorField" class="input-group colorpicker-component">
            <input type="text" id="canvasColor" name="canvasColor" value="#cccccc" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text"><i></i></span>
            </div>
          </div>
          <small class="form-text text-muted">The color of the canvas</small>
        </div>
        <div class="col-4 col-md-3 mt-4">
          <label for="columnColor">Columns color</label>
          <div id="columnColorField" class="input-group colorpicker-component">
            <input type="text" id="columnColor" name="columnColor" value="#ffffff" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text"><i></i></span>
            </div>
          </div>
          <small class="form-text text-muted">The color of the columns</small>
        </div>
      </div>

      <!-- SVG Font -->
      <div class="form-row">
        <div class="col-4 col-md-3 mt-4">
          <div class="form-check">
            <label style="width: 100%; padding-bottom: 7px;">&nbsp;</label>
            <input type="checkbox" class="form-check-input" id="columnTextEnabled" name="columnTextEnabled">
            <label class="form-check-label" for="columnTextEnabled" style="padding-bottom: 7px;">Show text</label>
            <small class="form-text text-muted">Show the column sizes as texts</small>
          </div>
        </div>
        <div class="col-4 col-md-3 mt-4">
          <label for="columnTextSize">Font size of text</label>
          <input id="columnTextSize" name="columnTextSize" type="number" class="form-control" placeholder="20" value="20">
          <small class="form-text text-muted">The font size for the optional column text</small>
        </div>
        <div class="col-4 col-md-3 mt-4">
          <label for="fontColor">Font color</label>
          <div id="fontColorField" class="input-group colorpicker-component">
            <input type="text" id="fontColor" name="fontColor" value="#FFFFFF" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text"><i></i></span>
            </div>
          </div>
          <small class="form-text text-muted">The color of the optional font</small>
        </div>
      </div>

      <div class="form-row">
        <div class="col-auto my-4">
          <button type="submit" id="btn_download" name="btn_download" value="download" class="btn btn-primary">Download SVG</button>
        </div>
        <div class="col-auto my-4">
          <button type="submit" id="btn_submit" name="btn_submit" class="btn btn-secondary">Preview SVG</button>
        </div>
      </div>

      <div id="svg-preview" class="d-none mb-4"></div>

    </form>
  </div>
  <script src="vendor/components/jquery/jquery.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="external/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script src="js/gridmaker.js"></script>
</body>

</html>
