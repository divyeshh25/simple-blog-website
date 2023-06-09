<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
  <div id="summernote"><p>Hello Summernote</p></div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
</body>

</html>

<div class="post-preview">
                       
                       <h2 class="post-title"><?= $data['title'] ?> </h2>
                       <p class="post-subtitle" style="font-size:20px">
                       <?php
                       $string2 = substr($data['subcat_desc'], 0, 200); 
                       ?>
                       <?= $string2 ?>
                       <?=  "<a href='post.php?postid=$id'>Read More </a>" ?>
                   </h3>
                   <p class="post-meta">
                       Posted by
                       <a style="color:brown"><?= $username?></a>
                      on <?= $data['time']?>
                   </p>
               </div>