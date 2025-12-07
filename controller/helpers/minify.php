<?php
// === Determine DOCUMENT_ROOT for both CLI and Web ===
if (php_sapi_name() === 'cli') {
    $isGitHook = true;
    if (!defined('DOCUMENT_ROOT')) {
        define('DOCUMENT_ROOT', getcwd());
    }
} else {
    $isGitHook = false;
    if (!defined('DOCUMENT_ROOT')) {
        define('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"]);
    }
}

// === Load config ===
include_once DOCUMENT_ROOT . '/config/dbconnect.php';
include_once DOCUMENT_ROOT . '/config/settings.php';

// === Minifiers ==
function minifyCSS($css) {
    $css = preg_replace('#/\*.*?\*/#s', '', $css);
    $css = preg_replace('/\s+/', ' ', $css);
    $css = preg_replace('/\s*([{};,:])\s*/', '$1', $css);
    return trim($css);
}

function minifyJS($js) {
    $placeholder = '___SPACE_PLACEHOLDER___';
    $js = preg_replace_callback(
        '/(\$\([\'"`][^\'"`]+)(\s+)([^\'"`]+[\'"`]\))/',
        fn($m) => $m[1] . $placeholder . $m[3],
        $js
    );
    $js = preg_replace('#/\*.*?\*/#s', '', $js);
    $js = preg_replace('#(?<!:)//.*$#m', '', $js);
    $js = preg_replace('/^\s*console\s*\.\s*\w+\s*\([^;]*\);\s*$/m', '', $js);
    $js = preg_replace('/\s*([{};,:])\s*/', '$1', $js);
    $js = preg_replace('/\s+/', ' ', $js);
    $js = str_replace(["\r", "\n"], '', $js);
    return trim(str_replace($placeholder, ' ', $js));
}

// === Walker ===
function minifyFilesInDir($dir, $type):int {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $steviloMinifiedFajlov = 0;
    foreach ($rii as $file) {
        if ($file->isDir()) continue;

        $path = $file->getPathname();

        if ($type === 'css' && pathinfo($path, PATHINFO_EXTENSION) === 'css' && !str_ends_with($path, '.min.css')) {
            $minPath = preg_replace('/\.css$/', '.min.css', $path);
            $original = file_get_contents($path);
            $minified = minifyCSS($original);
            file_put_contents($minPath, $minified);
            #echo "✅ Minified CSS: $path → $minPath\n";
            $steviloMinifiedFajlov++;
        } elseif ($type === 'js' && pathinfo($path, PATHINFO_EXTENSION) === 'js' && !str_ends_with($path, '.min.js')) {
            $minPath = preg_replace('/\.js$/', '.min.js', $path);
            $original = file_get_contents($path);
            $minified = minifyJS($original);
            file_put_contents($minPath, $minified);
            #echo "✅ Minified JS: $path → $minPath\n";
            $steviloMinifiedFajlov++;
        }
    }
    return $steviloMinifiedFajlov;
}
function logMinify($message){    
    $currentdatetime = date('Y-m-d H:i:s');
    $logFile = DOCUMENT_ROOT.'/logs/minifyLog.log'; // File to write to
    $data = "[$currentdatetime] - $message". "\n";    
    // Open the file for appending (creates the file if it doesn't exist)
    $handle = fopen($logFile, 'a');

    if ($handle) {
        fwrite($handle, $data); // Write the data
        fclose($handle); // Always close the file after writing
    } else {
        // Handle error opening file
        error_log("Cannot open log file: $logFile");
    }
}
// === Run ===
try{
    $steviloMinifiedCss = minifyFilesInDir(DOCUMENT_ROOT . '/styles/css', 'css');
    $steviloMinifiedJs = minifyFilesInDir(DOCUMENT_ROOT . '/styles/js', 'js');
    logMinify( "Minimizirano $steviloMinifiedCss CSS datotek.");
    logMinify( "Minimizirano $steviloMinifiedJs JS datotek.");
} catch (Exception $e) {
    logMinify("Napaka pri minimiziranju datotek: " . $e->getMessage());    
    exit("Napaka pri minimiziranju datotek: " . $e->getMessage());
}


