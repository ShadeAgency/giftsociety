<?php 
session_start();
include('includes/config.php');

    ?>

    <!-- Navigation -->
   <?php include('includes/header.php');?>
   <style>
       .max-lines {
  display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 3.6em;
  line-height: 1.8em;
}
       .max-lines1 {
  display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 1.6em;
  line-height: 1.8em;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  background: black !important;
  color: white !important;
}
.nav-tabs .nav-link {
  margin-bottom: -1px;
  background: 0 0;
  border: 1px solid #000 !important;
  border-top-left-radius: 0 !important;
  border-top-right-radius: 0 !important;
  width: 313px !important;
  border: 1px solid #000 !important;
}
.nav-tabs {
  border-bottom: 1px solid #000 !important;
}
   </style>

<?php 
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


?>



<div id="mine" class="card  border-0 shadow-lg rounded-0 mx-auto p-2 mine bg-offwhite">
        <div class="col-8 mx-auto">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 p-3 bg-danger">
                        <p class="fs-2 text-light fw-bold mb-1">Design</p>
                        <p class="text-light fw-bold">Handcraft The User Experience <span class="float-end"><i
                                    class="fa-solid fa-arrow-right-long"></i></span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 p-3 bg-warning">
                        <p class="fs-2 text-dark fw-bold mb-1">Design</p>
                        <p class="text-dark fw-bold">Handcraft The User Experience <span class="float-end"><i
                                    class="fa-solid fa-arrow-right-long"></i></span></p>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 p-3 bg-purple">
                        <p class="fs-2 text-dark fw-bold mb-1">Design</p>
                        <p class="text-light fw-bold">Handcraft The User Experience <span class="float-end"><i
                                    class="fa-solid fa-arrow-right-long"></i></span></p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <section class="my-5">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="slick1">
                                <?php $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostDetails,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and tblposts.CategoryId=6 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
while ($row=mysqli_fetch_array($query)) { ?>
                                <div class="p-2">
                                    <div class="card rounded-0 mb-3" style="background: url('admin/postimages/<?php echo htmlentities($row['PostImage']);?>') ;background-size:cover;height:300px;">
                                    </div>
                                    <p class="fs-4 fw-bold mb-1"><a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-black"><?php echo htmlentities($row['posttitle']);?></a></p>
                                     <p><!--category-->
                                    <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>
                                    <!--Subcategory--->
                                    <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a></p>
                                    <p class="mb-2 max-lines"><?php echo strip_tags($row['PostDetails'], 50); ?></p>
                                    <small class="text-danger">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                                </div>
                                <?php } ?>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="slick2">
                                 <?php $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostDetails,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and tblposts.CategoryId=3 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
while ($row=mysqli_fetch_array($query)) { ?>
                                <div class="p-2">
                                    <div class="card rounded-0 mb-3" style="background: url('admin/postimages/<?php echo htmlentities($row['PostImage']);?>') ;background-size:cover;height:150px;">
                                    </div>
                                    <p class="fs-6 fw-bold mb-1"><a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-black"><?php echo htmlentities($row['posttitle']);?></a></p>
                                    <small class="text-danger">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                                </div>
                              <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="slick1">
                            <?php $query=mysqli_query($con,"select id,Postimage from tblimage");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                            <div class="p-2">
                                <div class="card rounded-0 mb-3" style="background: url('admin/postimages/<?php echo htmlentities($row['Postimage']);?>') ;background-size:cover;height:490px;">
                                </div>
                            </div>
                            <?php } ?>
                            
                          </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-md-8">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <button class="nav-link active text-black" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Most Recent</button>
                              <button class="nav-link  text-black" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Top Recommended</button>
                              <button class="nav-link text-black" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Most Viewed</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?php
                            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostDetails,tblposts.PostImage,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
                            while ($row=mysqli_fetch_array($query)) {
                            
                            ?>
                            <div class="card py-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card" style="background: url('admin/postimages/<?php echo htmlentities($row['PostImage']);?>') ; background-size: cover; height:200px"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card">
                                            <p class="fs-3 fw-bold"><a class="text-black" href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a></p>
                                             <p class="mb-2 max-lines"><?php echo strip_tags($row['PostDetails'], 50); ?></p>
                                            <small class="text-danger">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                         <?php } ?>
                           
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <?php $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                            while ($row=mysqli_fetch_array($query)) {
                            ?>
                            <div class="card py-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card" style="background: url('admin/postimages/<?php echo htmlentities($row['PostImage']);?>') ; background-size: cover; height:200px"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card">
                                             <p class="fs-3 fw-bold"><a class="text-black" href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a></p>
                                            <p class="mb-2 max-lines"><?php echo strip_tags($row['PostDetails'], 50); ?></p>
                                            <small class="text-danger">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <?php
                            $query1=mysqli_query($con,"select tblposts.id as pid,tblposts.PostDetails,tblposts.PostImage,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId  order by viewCounter desc limit 5");
                            while ($result=mysqli_fetch_array($query1)) {
                            
                            ?>
                            <div class="card py-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card" style="background: url('admin/postimages/<?php echo htmlentities($result['PostImage']);?>') ; background-size: cover; height:200px"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card">
                                            <p class="fs-3 fw-bold"> <a class="text-black" href="news-details.php?nid=<?php echo htmlentities($result['pid'])?>"><?php echo htmlentities($result['posttitle']);?></a></p>
                                            <p class="mb-2 max-lines"><?php echo strip_tags($result['PostDetails'], 50); ?></p>
                                    <small class="text-danger">Posted on <?php echo htmlentities($result['postingdate']);?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        </div>              
                    </div>
                    <div class="col-md-4 px-5">
                        <div class="card">
                            <p class="fs-3 fw-bold mb-0">Categories</p>
                            <hr class="mb-3 mt-0">
                            <div class="card mb-3">
                                <div class="row">
                                   
                                    <div class="col-12">
                                        <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory where tblcategory.Is_Active=1");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <div class="card p-2">
                                          <a class="text-black text-decoration-none" href="category.php?catid=<?php echo htmlentities($row['id'])?>"><i class="fa fa-leaf "></i>     <?php echo htmlentities($row['CategoryName']);?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 mb-3">
                         <a href="register.php"><video class="mx-auto" autoplay="" loop="" src="img/Be1.mp4" style="width: 100%;height: 100%;border: 4px solid #000;"></video></a> 
                        </div>
                        <div class="card mb-3">
                            <h5>Share With Your Friends</h5>
                            <ul class="list-group list-group-horizontal mx-auto">
                                <li class="list-group-item">A<li>
                                <li class="list-group-item">A</li>
                                <li class="list-group-item">A</li>
                                <li class="list-group-item">A</li>
                                <li class="list-group-item">A</li>
                                <li class="list-group-item">A</li>
                                
                              </ul>
                        </div>
                        <div class="card">
                            <p class="fs-3 fw-bold mb-0">Popular Post</p>
                            <hr class="mb-3 mt-0">
                            <div class="slick3">
                            <?php
                            $query1=mysqli_query($con,"select tblposts.id as pid,tblposts.PostDetails,tblposts.PostImage,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId  order by viewCounter desc limit 5");
                            while ($result=mysqli_fetch_array($query1)) {
                            
                            ?>
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card rounded-0" style="background: url('admin/postimages/<?php echo htmlentities($result['PostImage']);?>') ; background-size: cover; height:100px"></div>
                                    </div>
                                    <div class="col-9">
                                        <div class="card">
                                             <p class="fs-6 fw-bold "> <a class="text-black max-lines1" href="news-details.php?nid=<?php echo htmlentities($result['pid'])?>"><?php echo htmlentities($result['posttitle']);?></a></p>
                                            <p class="mb-2 max-lines"><small><?php echo strip_tags($result['PostDetails'], 50); ?></small></p>
                                            <small class="text-danger">Posted on <?php echo htmlentities($result['postingdate']);?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="switch" class="card position-absolute border-0" style="top: 110px;right:30px;">
        <p class="mb-0 fw-bold small">switch mode <img src="img/curvearrow.gif" alt="" width="30px"></p>
    </div>
    
    
    <!-- Footer -->
      <?php include('includes/footer.php');?>

<script type="text/javascript">
    $(".div").each(function()  {
        var limit = 20;
        var chars = $("#myDiv").text(); 
        if (chars.length > limit) {
            var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
            var dots = $("<span class='dots'>... </span>");
            // var readMore = $("<a class='read-more' href='news-details.php?nid=<?php echo htmlentities($row['pid'])?>'>Read More</a>");
            

            $("#myDiv").empty()
                .append(visiblePart)
                .append(dots)
                .append(readMore)
                
        }
    });
</script>

 
</head>
  </body>

</html>
