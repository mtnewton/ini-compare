<?php

function d($data) {var_export($data);}
function dd($data) {var_export($data);die;}

function compare(string $filePath1, string $filePath2)
{
    $maxLengths = [3, max(10, strlen($filePath1)), max(10, strlen($filePath2))];
    $values = [];
    foreach([$filePath1, $filePath2] as $index => $filePath) {

        $contents = file_get_contents($filePath);
        $lines = explode("\n", $contents);
        foreach($lines as $line) {
            if (strpos($line, '[') === 0 || strpos($line, '=') == 0) continue;
            $split = explode('=', $line, 2);
            if (!isset($values[$split[0]])) {
                $values[$split[0]] = ['!!NotSet!!', '!!NotSet!!'];
            }
            $values[$split[0]][$index] = $split[1];
            $maxLengths[0] = max($maxLengths[0], strlen($split[0]));
            $maxLengths[$index+1] = max($maxLengths[$index+1], strlen($split[1]));
        }
    }

    $mask = "| %-{$maxLengths[0]}s | %-{$maxLengths[1]}s | %-{$maxLengths[2]}s |\n";
    printf($mask, 'Key', $filePath1, $filePath2);
    print('|' . str_repeat('-', 8 + $maxLengths[0] + $maxLengths[1] + $maxLengths[2]) . "|\n");
    foreach($values as $k => $v) {
        if ($v[0] !== $v[1]) {
            printf($mask, $k, $v[0], $v[1]);
        }
    }
}

try {
    compare('file1.ini', 'file2.ini');
}catch(Exception $e) {
    print($e->getMessage());
}
