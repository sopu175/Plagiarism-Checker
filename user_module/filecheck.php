



<?php
session_start();
include "../db/dbconfig.php";
include "doctotext.php";


$user_Id = $_SESSION['id'];
$sql = "SELECT * FROM file ";
$result = mysqli_query($con, $sql);
$forAllSQL = "SELECT * FROM file";
$resultForAll = mysqli_query($con, $forAllSQL);








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




function guess_encoding( $str){
    $blacklist = array (
        'pass',
        'auto',
        'wchar',
        'byte2be',
        'byte2le',
        'byte4be',
        'byte4le',
        'BASE64',
        'UUENCODE',
        'HTML-ENTITIES',
        '7bit',
        '8bit'
    );
    $encodings = array_flip ( mb_list_encodings () );
    foreach ( $blacklist as $tmp ) {
        unset ( $encodings [$tmp] );
    }
    $encodings = array_keys ( $encodings );
    $detected = mb_detect_encoding ( $str, $encodings, true );
    return ( string ) $detected;
}


function parseWord($userDoc)
{
    $fileHandle = fopen($userDoc, "r");
    $line = @fread($fileHandle, filesize($userDoc));
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


if (isset($_POST['submit'])) {
    $myFileDestination = "../". $_POST['myFileDestination'];
    $SecondFileDestination = "../" . $_POST['SecondFileDestination'];
    echo $myFileDestination ."<br>";
    echo $SecondFileDestination ;
    $extension = pathinfo($myFileDestination, PATHINFO_EXTENSION);

    /*  extension check */
       if ($extension == "docx") {

        }
       if ($extension == "pdf") {


        }
        $pdf_value = "<p class='pdf' id='pdf-text' style='color:black;'></p> " . "<br><br><br>";





    $myFileArray = array();
    $secondFileArray = array();
    $myFile = preg_replace('/[.,]/', '', file_get_contents($myFileDestination, FALSE));

    $secondFile = preg_replace('/[.,]/', '', file_get_contents($SecondFileDestination, FALSE));

    $converter = new DocxToTextConversion('../uploads/iamsaiful.docx');



    echo '<script>';
    echo 'console.log('. json_encode( $converter->convertToText() ) .')';
    echo '</script>';

    $newstring = implode("/", preg_split("/[\s]	+/", $myFile));
    $newstring2 = implode("/", preg_split("/[\s]	+/", $secondFile));


    echo "Fuck=" . json_encode($newstring2);




    $iso88591 =  parseWord($SecondFileDestination); // file must be ISO-8859-1 encoded
    $utf8_1 = utf8_encode($iso88591);
    $utf8_2 = iconv('ISO-8859-1', 'UTF-8', $iso88591);
    $utf8_2 = mb_convert_encoding($iso88591, 'UTF-8', 'ISO-8859-1');


    /*function limit_words($text)
    {
        $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
        array_unshift($split, " ");
        unset($split[0]);
        $truncated = '';
        $j = 1;
        $k = 0;
        $a = array();
        for ($i = 1; $i <= count($split); $i = $i + 2) {
            $truncated .= $split[$i] . $split[$i + 1];
            if ($j % 2 == 0) {
                $a[$k] = $truncated;
                $truncated = '';
                $k++;
                $j = 0;
            }
            $j++;
        }
        file_put_contents("newFile.txt", var_export($a, true));
        return ($a);
    }*/

    function limit_word($text)
    {
        $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
        array_unshift($split, " ");
        unset($split[0]);
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
        file_put_contents("newFile2.txt", var_export($a, true));
        return ($a);
    }

    $myFileArray=(limit_word($newstring));
    //print_r($myFileArray);
    $secondFileArray=(limit_word($newstring2));
   // print_r($secondFileArray);

    $count=0;
    for($k=0;$k<count($myFileArray);$k=$k+1){
        for($j=0;$j<count($secondFileArray);$j++){
            if($myFileArray[$k]==$secondFileArray[$j]){
                $count=$count+1;
                echo $count;
            }
            else
                $count=$count+0;
        }
    }

    $percent = (round ($count/count($myFileArray)*100,2));
    echo ("Similarity = ").$percent." %";

}


?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/lightgallery.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/slick.js"></script>
<script src="../assets/js/dropzone.js"></script>
<script src="../assets/js/jquery.mCustomScrollbar.js"></script>

	<script src="../assets/js/solid.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.9.597/pdf.js"></script>
	<script src="../assets/js/custom.js"></script>

	<script>

    // Path to PDF file

    var url = "<?php echo $myFileDestination ?>";
    PDFJS.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.9.597/pdf.worker.js';


    PDFJS.getDocument(url).then(function (pdf) {
        var pdfDocument = pdf;
        var pagesPromises = [];

        for (var i = 0; i < pdf.numPages; i++) {
            // Required to prevent that i is always the total of pages
            (function (pageNumber) {
                pagesPromises.push(getPageText(pageNumber, pdfDocument));
            })(i + 1);
        }

        Promise.all(pagesPromises).then(function (pagesText) {
            // Remove loading
            $("#loading-info").remove();

            // Render text
            for(var i = 0;i < pagesText.length;i++){
                /*$("#pdf-text").append("<div><h3>Page "+ (i + 1) +"</h3><p>"+pagesText[i]+"</p><br></div>")*/
                $("#pdf-text").append("<div style='color: black;'>"+pagesText[i]+"</div>")
            }
        });

    }, function (reason) {
        // PDF loading error
        console.error(reason);
    });


    /**
     * Retrieves the text of a specif page within a PDF Document obtained through pdf.js
     *
     * @param {Integer} pageNum Specifies the number of the page
     * @param {PDFDocument} PDFDocumentInstance The PDF document obtained
     **/
    function getPageText(pageNum, PDFDocumentInstance) {
        // Return a Promise that is solved once the text of the page is retrieven
        return new Promise(function (resolve, reject) {
            PDFDocumentInstance.getPage(pageNum).then(function (pdfPage) {
                // The main trick to obtain the text of the PDF page, use the getTextContent method
                pdfPage.getTextContent().then(function (textContent) {
                    var textItems = textContent.items;
                    var finalString = "";

                    // Concatenate the string of the item to the final string
                    for (var i = 0; i < textItems.length; i++) {
                        var item = textItems[i];

                        finalString += item.str + " ";
                    }

                    // Solve promise with the text retrieven from the page
                    resolve(finalString);
                });
            });
        });
    }



    	</script>