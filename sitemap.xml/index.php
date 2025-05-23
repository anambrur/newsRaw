<?php
header( "Content-type: text/xml");
date_default_timezone_set('America/Los_Angeles');
 echo "<urlset
      xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'
      xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
      xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>
<url>
  
    <loc>https://www.ajkersylhet.com/</loc>
             
    <lastmod>2022-08-26T18:00:15+00:00</lastmod>   
    <priority>1.00</priority>
  </url>";
 


 require_once '../db.php';
 require_once "../functions/limit.php";
 

 
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC LIMIT 999 OFFSET 0");          
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
    
    
    $phpdate = strtotime($row["PostingDate"]);
    $mysqldate = date( 'Y-m-d\TH:i:sP', $phpdate );
    $title=$row["PostTitle"];
    $link='https://www.ajkersylhet.com/news-details?nid='.$row["id"];
    $date= $mysqldate;
    $description = html_entity_decode(strip_tags(limit_words($row["PostDetails"],15))); 
 
   echo "
   
   <url>
    <loc>$link</loc>

    <lastmod>$date</lastmod>
   
    <priority>0.80</priority>
  </url>
   

   
   ";
 }
 echo "</urlset>";
?>