<?php

require("vendor/autoload.php");

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Texts\SVGText;


// When "columns" string was set
if (isset($_POST["columns"])) {

  $columns = $_POST["columns"];
  $cols = explode("-", $columns);
  $colCounter = sizeof($cols);

  $colTotal = 12;
  if (array_key_exists('colTotal', $_POST)) {
    $colTotal = $_POST['colTotal'];
  }

  $width = 32;
  if (array_key_exists('width', $_POST)) {
    $width = $_POST['width'];
  }

  $height = 32;
  if (array_key_exists('height', $_POST)) {
    $height = $_POST['height'];
  }

  $borderWidth = 1;
  if (array_key_exists('borderWidth', $_POST)) {
    $borderWidth = $_POST['borderWidth'];
  }

  $canvasPadding = 2;
  if (array_key_exists('canvasPadding', $_POST)) {
    $canvasPadding = $_POST['canvasPadding'];
  }

  $borderColor = '#000000';
  if (array_key_exists('borderColor', $_POST)) {
    $borderColor = $_POST['borderColor'];
  }

  $canvasColor = '#cecece';
  if (array_key_exists('canvasColor', $_POST)) {
    $canvasColor = $_POST['canvasColor'];
  }

  $columnColor = '#ffffff';
  if (array_key_exists('columnColor', $_POST)) {
    $columnColor = $_POST['columnColor'];
  }

  $fontColor = '#FFFFFF';
  if (array_key_exists('fontColor', $_POST)) {
    $fontColor = $_POST['fontColor'];
  }

  $columnTextEnable = false;
  if (array_key_exists('columnTextEnabled', $_POST)) {
    $columnTextEnable = true;
  }

  $columnTextSize = 20;
  if (array_key_exists('columnTextSize', $_POST)) {
    $columnTextSize = $_POST['columnTextSize'];
  }

  // New SVG image
  $image = new SVG($width, $height);
  $doc = $image->getDocument();

  // Add background for the "border"
  $bgBorder = new SVGRect(0,0, $width, $height);
  $bgBorder->setStyle('fill', $borderColor);
  $doc->addChild($bgBorder);

  // Add "canvas" background
  $bgCanvas = new SVGRect($borderWidth, $borderWidth, ($width - (2 * $borderWidth)), ($height - (2 * $borderWidth)));
  $bgCanvas->setStyle('fill', $canvasColor);
  $doc->addCHild($bgCanvas);

  // Calculate for columns
  $colStartX = 0 + $borderWidth + $canvasPadding;
  $colStartY = $colStartX;
  $colHeight = $height - (2 * $borderWidth) - (2 * $canvasPadding);
  $colSection = ($width - (2 * $borderWidth) - (2 * $canvasPadding) - (($colCounter - 1) * $canvasPadding)) / $colTotal;

  // Go through and render each single column
  foreach ($cols as $col) {
    // Column
    $colWidth = $col * $colSection;
    $column = new SVGRect($colStartX, $colStartY, $colWidth, $colHeight);
    $column->setStyle('fill', $columnColor);
    $doc->addChild($column);
    // Text
    if ($columnTextEnable) {
      $centerValue = $width/50;
      $text = new SVGText($col, $colStartX + ($colWidth / 2) - $centerValue, $colStartY + ($colHeight / 2));
      $text->setSize($columnTextSize);
      $text->setStyle('stroke', $fontColor);
      $doc->addChild($text);
    }

    // Prepare new colStartX
    $colStartX += $colWidth + $canvasPadding;
  }

  // Output image
  header('Content-Type: image/svg+xml');

  // Force download if requested
  if (!empty($_POST['btn_download'])) {
    header('Content-Disposition: attachment; filename="cols-' . $_POST['columns'] . '.svg"');
  }

  echo $image;
}

?>
