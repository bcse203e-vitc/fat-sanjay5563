<?php
function lineSum(string $filename, int $lineNumber): int {
    if (!file_exists($filename)) return 0;

    $handle = fopen($filename, "r");
    if (!$handle) return 0;

    $current = 1;

    while (($line = fgets($handle)) !== false) {

        // ignore blank lines and comment lines
        if (trim($line) === "" || str_starts_with(trim($line), "#")) {
            $current++;
            continue;
        }

        if ($current === $lineNumber) {
            $parts = preg_split('/\s+/', trim($line));
            $sum = 0;

            foreach ($parts as $p) {
                if (preg_match('/^-?\d+$/', $p)) {
                    $sum += intval($p);
                }
            }

            fclose($handle);
            return $sum;
        }

        $current++;
    }

    fclose($handle);
    return 0;
}
?>

