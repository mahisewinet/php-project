<?php 
 require_once("includes/db.php");
?>
<?php 
 require_once("includes/functions.php");
?>
<?php 
 require_once("includes/Sessions.php");
?>
<?php 
 if(isset($_POST["submit"])){
    $category= $_POST["Title"];
    $Admin= "Mahlet";
    date_default_timezone_set("Africa/Addis_Ababa");
    $DateTime=date("d-m-Y");
    $DateTime.=" ";
    $DateTime.= date("h:i:sa");
    if(empty($category)){
       $_SESSION["Error"]= "All fields are empty";
       redirect_to("Categories.php");
    }else if(strlen($category)<3){
        $_SESSION["Error"]= "Category title must be greater than two characters!";
        redirect_to("Categories.php");
    }else if(strlen($category)>50){
        $_SESSION["Error"]= "Category title must be less than 50 characters!";
        redirect_to("Categories.php");
    }else{
        //query to insert category title when everything is fine
        $sql= "INSERT INTO Category(title,Author,datetime)";
        $sql.="Values(:categoryName,:adminName,:dateTime)";
        $stmt= $connectingDb->prepare($sql);
        $data = [
            ':categoryName' => $category,
            ':adminName' => $Admin,
            ':dateTime' => $DateTime,
        ];
        $Execute= $stmt->execute();
        if($Execute){
            $_SESSION["Success"]= "Category added successfuly!";
            redirect_to("Basic.html");
        }else{
            $_SESSION["Error"]= "Something went wrong, Try Agian!";
            redirect_to("Categories.php");
        }
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Categories</title>
</head>
<body>
    <div style="height: 10px; background: #f1c0bc;"></div>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark  shadow ">
        <div class="container ">
           <a href="#" class="navbar-brand">
               <img src="images/makeup.png" alt="" width="40px" height="40px" class="bg-white p-2 rounded">
               Mahi Beauty Tips Blog
           </a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarcollapse"  aria-controls="navbarNavDropdown"  aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarcollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="Myprofile.php" class="nav-link"><i class="fa-solid fa-user text-success"></i> My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="Dashbord.php" class="nav-link">Dashbord</a>
                    </li>
                    <li class="nav-item">
                        <a href="Posts.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="Categories.php" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="Admins.php" class="nav-link">Manage Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="Comments.php" class="nav-link">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="Logout.php" class="nav-link text-danger"><i class="fa-solid fa-user-xmark"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #f1c0bc;"></div>

    <!-- HEADER SECTION -->

    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <h1><i class="fa-solid fa-pen-to-square" style="color: #f1c0bc;"></i>Manage Categories</h1>
                </div>  
            </div>
        </div>
    </header>
    <!-- END OF HEAD SECTION -->

    <!-- MAIN SECTION -->
    <section class="container py-3 mb-4 mt-2">
       <div class="row">
           <div class='offset-lg-1 col-lg-10 ' style="height: 265px;">
               <?php 
                 echo ErrorMessage();
                 echo SuccessMessage();
               ?>
               <form action="Categories.php" method="POST">
                 <div class="card bg-secondary text-white mb-3">
                    <div class="card-header">
                        <h1>Add New Category</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group mb-3">
                            <label for="title">Category title: </label>
                            <input type="text" class="form-control" name="Title" id="title" placeholder="Add ur category title" value="">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <a href="Dashbord.php" class="btn btn-warning col-12 btn-lg">
                                    <i class="fa-solid fa-arrow-left"></i> Bach to Dashbord
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" name="submit" class="btn btn-success col-12 btn-lg">
                                <i class="fa-solid fa-check"></i> Publish
                                </button>
                            </div>
                        </div>
                    </div>
                 </div>
               </form>
          </div>
       </div>
    </section>

    <!-- END OF MAIN SECTION -->

    <footer class="bg-dark text-white">
         <div class="container">
            <div class="row">
                <p class="lead text-center">Theme By | Mahlet Sewinet | <span id="year"></span> &copy; ----All rights Reserved!</p>
                <p class="text-center small">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum velit vero, 
                   tempore in possimus dolores minus quasi facilis, ad amet itaque fugiat ex
                   cepturi laudantium laboriosam incidunt dignissimos asperiores. Iusto, sap
                   iente at? Suscipit.
                </p>
            </div>
         </div>
    </footer>
    <div style="height: 10px; background: #f1c0bc;"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#year").text(new Date().getFullYear());
</script>
</body>
</html>
