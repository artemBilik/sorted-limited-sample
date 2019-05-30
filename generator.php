<?php

for ($i = 0; $i < 100; $i++) {
	try {
		$file = new SplFileObject(sprintf('%s/files/%d.csv', __DIR__, $i), 'w');
		$str = '';
		for ($k = 0; $k < 200000; $k++) {
			$id = rand(1, 100000);
			$str .= sprintf('%d;%s;condition;state;%f%s', $id, $id, number_format((float)rand(1, 1000000), 2), PHP_EOL);
		}
		$file->fwrite($str);
	} catch (RuntimeException $e) {
		//
	}
}
echo 'Generated 100 files of 200 000 lines each.' . PHP_EOL;