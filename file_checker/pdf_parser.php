<?php






/* File One Function For get Content */
function fileOneContent($text)
{
    $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
    array_unshift($split, " ");

    $truncated = '';
    $j = 1;
    $k = 0;
    $a = array();
    for ($i = 0; $i < count($split); $i = $i + 2) {
        $truncated .= $split[$i] . $split[$i + 1];
        if ($j % 2 == 0) {
            $a[$k] = $truncated;
            $truncated = '';
            $k++;
            $j = 0;
        }
        $j++;
    }
    file_put_contents("FileOneContent.txt", var_export($a, true));
    return ($a);
}

/* File One Function For get Content */


/* File two Function For get Content */
function fileTwoContent($text)
{
    $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
    array_unshift($split, " ");

    $truncated = '';
    $j = 1;
    $k = 0;
    $a = array();
    for ($i = 0; $i < count($split); $i = $i + 2) {
        $truncated .= $split[$i] . $split[$i + 1];
        if ($j % 2 == 0) {
            $a[$k] = $truncated;
            $truncated = '';
            $k++;
            $j = 0;
        }
        $j++;
    }
    file_put_contents("FileTwoContent.txt", var_export($a, true));
    return ($a);
}

/* File One Function For get Content */

/* read doc file content */
function read_doc($name) {
    $fileHandle = fopen($name, "r");
    $line = @fread($fileHandle, filesize($name));
    $lines = explode(chr(0x0D),$line);
    $outtext = "";
    foreach($lines as $thisline)
    {
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE)||(strlen($thisline)==0))
        {
        } else {
            $outtext .= $thisline." ";
        }
    }
    $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
    return $outtext;
}
/* read doc file content end */



/* read docx file content */
function read_docx($name){

    $striped_content = '';
    $content = '';

    $zip = zip_open($name);

    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
}
/* read docx file content */



if (isset($_POST['submit'])) {
    $count = 0;
    $first_file_pdf = $_POST['pdf_text'];
    $second_file_pdf = $_POST['pdf_text_2'];
    $second_file = $_POST['second_file'];
    $Second_FileDestination = $_POST['second_file_destination'];

    $doc_file_content_one = file_put_contents("pdf_bahon.txt", var_export($first_file_pdf, true));
    $doc_file_content_two = file_put_contents("pdf_bahon_2.txt", var_export($first_file_pdf, true));

    $File_one = preg_replace('/[\/:,\'.;""|()^0-9]/', '', file_get_contents('pdf_bahon.txt', true));
    $File_two = preg_replace('/[\/:,.\';""|()^0-9]/', '', file_get_contents('pdf_bahon_2.txt', true));

    if($second_file == 1){

        $File_two = preg_replace('/[.,]/', '', file_get_contents($Second_FileDestination, FALSE));


        $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
        $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


        $File_One_Array = (fileOneContent($File_One_String));
        $File_Two_Array = (fileTwoContent($File_Two_String));


        /* check the two files content */
        $count = 0;
        for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
            for ($j = 0; $j < count($File_Two_Array); $j++) {
                if ($File_One_Array[$k] == $File_Two_Array[$j]) {
                    $count = $count + 1;

                } else
                    $count = $count + 0;
            }
        }
        /* check the two files content */


        $percent = (round($count / (count($File_One_Array) ) * 100, 2));
        echo $percent;
    }

    if($second_file == 2){

        $doc_file_content = file_put_contents("DocFileCOntent.txt", var_export(read_docx($Second_FileDestination), true));;

        $File_two = preg_replace('/[\/:,\'.;""|()^0-9]/', '', file_get_contents('DocFileCOntent.txt', FALSE));


        $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
        $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


        $File_One_Array = (fileOneContent($File_One_String));
        $File_Two_Array = (fileTwoContent($File_Two_String));



        /* check the two files content */
        $count = 0;
        for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
            for ($j = 0; $j < count($File_Two_Array); $j++) {
                if ($File_One_Array[$k] == $File_Two_Array[$j]) {
                    $count = $count + 1;

                } else
                    $count = $count + 0;
            }
        }
        /* check the two files content */


        $percent = (round($count / (count($File_One_Array) ) * 100, 2));

        echo $percent;
    }

    if($second_file == 3){
        $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
        $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


        $File_One_Array = (fileOneContent($File_One_String));
        $File_Two_Array = (fileTwoContent($File_Two_String));



        /* check the two files content */
        $count = 0;
        $couter = 0;
        for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
            for ($j = 0; $j < count($File_Two_Array); $j++) {
                if ($File_One_Array[$k] == $File_Two_Array[$j]) {

                    $count = $count + 1;


                } else
                {
                    $count = $count + 0;
                }



            }


        }

        for ($k = 0; $k < count($File_Two_Array); $k = $k + 1) {
            for ($j = 0; $j < count($File_One_Array); $j++) {
                if ($File_Two_Array[$k] == $File_One_Array[$j]) {


                    $couter = $couter + 1;

                } else
                {
                    $couter = $couter + 0;
                }



            }


        }

        /* check the two files content */

        echo "file one = " .count($File_One_Array) ."<br>";
        echo "file tow = " .count($File_Two_Array) ."<br>";
        echo  $count . "<br>";
        $percent = (($count ) / (count($File_One_Array) ) * 100);

        echo $percent;
    }
}
?>