<!DOCTYPE html>
<html>    
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>留言區</title>
<link rel="stylesheet" type="text/css" href="comment.css"/>


<?php
   $msg = "";
   // 檢查是否是表單送回
   if ( isset($_POST["Name"]) ) {
      $file = "comment.txt";
      if ( !file_exists($file) ) { // 檔案不存在
         $fp = fopen($file, "w");  // 建立檔案
         fclose($fp);
      }
      $name= $_POST["Name"];
      $messages = nl2br($_POST["Message"]);
      date_default_timezone_set("Asia/Taipei");
      $fp = fopen($file, "a");  // 開啟檔案
      $today = date("Y年m月d日 h:i:s");
      // 建立留言訊息
      $msg  = "<span><b>留言時間：</b>".$today."</span><br/>";
      $msg .= "<span><b>發文者：</b><span style='color:red'>".$name."</span></span><br/>";   
      $msg .= "<span><b>留言：</b><br/>".$messages."</span><br/><hr/>";
      fputs($fp, $msg);  // 寫入檔案
      fclose($fp);       // 關閉檔案 
      header("refresh:0");
   }
?>
</head>
<body>
   <header>
      <h1>留言板</h1>
   </header>

   <nav>
        <ul id="menu">
        <li><a href="#comment">我要留言</a></li>
        </ul>
    </nav>

   <main>
      <section id="intro">
         <h2>關於留言板</h2>
         <p>
            測試用網站，尚未完成<br>
            有很多瑕疵，請多包涵<br>
            本站雖然可以留言<br>
            但因為某些因素<br>
            留言在超過<span style="color:red">半小時後</span><br>
            基本上會自動被刪除<br>
            所以重要之事別在這裡留<br>
            此站僅供娛樂使用而已

         </p>
      </section>

      <section id="commentarea">
         <h2>留言板</h2>
            <?php
               $file = "comment.txt";
               // 檢查檔案是否存在, 且不是空檔案
               if ( !file_exists($file) or filesize($file) == 0 )
                  echo "<h3>目前沒有任何留言！</h3><hr/>";
               else
                  readfile($file);  // 讀取和顯示留言
               ?><a href="index.php">刷新留言</a><br/>
               
      </section>
      <section id="comment">
         <form action="index.php" method="post">
         <table border="2">
         <tr>
            <td id="name"><input type="text" size="30" name="Name" placeholder="發文者"/></td>
         </tr>
         <tr>   
            <td>
               <textarea name="Message" rows="2" cols="30" placeholder="留言區"></textarea>
            </td>
         </tr>
         <tr>    
            <td id="bottom" colspan="2" align="center">
               <input type="submit" name="Send" value="送出留言"/>
               <input type="reset" name="Reset" value="重設欄位"/></td>
         </tr>
         </table><?php echo $msg ?>
         </form>
      </section>
   </main>
   <footer>
      <a href="https://doiya3.github.io/">我要回首頁</a>
   </footer>
</body>
</html>