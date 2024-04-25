<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}


/**
 * Load a view
 * 
 * @param string $name
 * @return void
 */

function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found!";
    }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 */

function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "View '{$name}' not found!";
    }
}


/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}


/**
 * Inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */

function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

/**
 * Short preview of a longer text
 * 
 * @param string $longText
 * @param int $maxChars
 * @return string
 */

function showExcerpt($longText, $maxChars)
{
    return substr($longText, 0, $maxChars) . '...';
}

/**
 * Make slug from string
 * 
 * @param string $text
 * @return string
 */

function slugify($text)
{
    // Convert the text to lowercase
    $text = strtolower($text);

    // Replace spaces with underscores
    $text = str_replace(' ', '_', $text);

    // Remove special characters and replace accented characters
    $text = preg_replace('/[^a-z0-9_\s]/', '', $text);
    $text = str_replace(['č', 'ć', 'š', 'ž', 'đ'], ['c', 'c', 's', 'z', 'd'], $text);

    // Remove consecutive underscores
    $text = preg_replace('/_+/', '_', $text);

    // Trim underscores from the beginning and end of the string
    $text = trim($text, '_');

    return $text;
}


/**
 * Count products per brand
 * 
 * @param array $products
 * @param string $brand
 * @return array
 */

function productCount($products, $brand)
{
    $count = 0;
    foreach ($products as $product) {
        if ($product->brand_id === $brand->id) {
            $count++;
        }
    }
    return $count;
}
