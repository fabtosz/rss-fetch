<?php 

namespace BartoszFabianski\Core\Utils;

class CsvManager {

	public static function saveSimple(string $path, array $feed) : void {

		//try-catch
		$file = fopen($path, 'w');

		fputcsv($file, array_keys($feed[0]));
		foreach ($feed as $row)
		{
			fputcsv($file, $row);
		}

		fclose($file);
	} 

	public static function saveExtended(string $path, array $feed) : void {

		//try-catch
		$file = fopen($path, 'a');

		fputcsv($file, array_keys($feed[0]));
		foreach ($feed as $row)
		{
			fputcsv($file, $row);
		}

		fclose($file);
	}
}