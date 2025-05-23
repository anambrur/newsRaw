<?php
header( "Content-type: text/xml");
 echo "<?xml version='1.0' encoding='UTF-8'?>
 
 <rss version='2.0'>
 <channel>
 <title>Ajker Sylhet | Google Feed RSS</title>
 <link>/</link>
 <description>Cloud Google Feed</description>
 <language>en-us</language>";
 


 require_once 'db.php';
 require_once "functions/limit.php";
 
 

 
$db->exec("set names utf8");
$result = $db->prepare("SELECT * FROM tblposts WHERE On_Gfeed = 1 ORDER BY id DESC");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
    
   $title=$row["PostTitle"];
   $link='https://www.https://ajkersylhet.com/news-details.php?nid='.$row["id"];
   $description = html_entity_decode(strip_tags(limit_words($row["PostDetails"],15))); 
   $postimage='src="https://www.https://ajkersylhet.com/admin/postimages/'.$row["PostImage"].'"';
 
   echo "<item>
   <title>$title</title>
   <link>$link</link>
   <image>$postimage</image>
   <site_title>Ajker Sylhet</site_title>
   <story>$description</story>
   </item>";
 }
 echo "</channel></rss>";
?>