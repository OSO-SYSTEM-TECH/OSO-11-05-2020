<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
    

    if(isset($_GET['restaurant_id']))
    {
         
      $rest_qry="SELECT * FROM tbl_restaurants where id='".$_GET['restaurant_id']."'";
      $rest_result=mysqli_query($mysqli,$rest_qry);
      $rest_row=mysqli_fetch_assoc($rest_result);

    }
    else
    {
      header( "Location:manage_restaurants.php");
      exit; 
    }
      
     $data_qry="SELECT * FROM tbl_menu_category
      WHERE tbl_menu_category.restaurant_id='".$_GET['restaurant_id']."' 
      ORDER BY tbl_menu_category.cid DESC"; 
     $result=mysqli_query($mysqli,$data_qry);
 
	
	if(isset($_GET['cat_id']))
	{
  
		Delete('tbl_menu_category','cid='.$_GET['cat_id'].'');
 
		$_SESSION['msg']="12";
		header( "Location:manage_menu_category.php?restaurant_id=".$_GET['restaurant_id']);
		exit;
		
	}	
	 
?>
                
     <div class="m-grid__item m-grid__item--fluid m-wrapper">
          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-subheader__title ">
                  Restaurant : <?php echo $rest_row['restaurant_name'];?>
                </h3>
              </div>
              <div>
                 
              </div>
            </div>
          </div>
          <!-- END: Subheader -->
          <div class="m-content">
            <div class="row">
              <div class="col-lg-3">
                <div class="m-portlet m-portlet--full-height ">
                  <div class="m-portlet__body">
                    <div class="m-card-profile">
                      <div class="m-card-profile__title m--hide">
                        Your Dashboard
                      </div>
                      <div class="m-card-profile__pic">
                        <div class="m-card-profile__pic-wrapper">
                          <img src="images/<?php echo $rest_row['restaurant_image'];?>" alt=""/>
                        </div>
                      </div>
                      <div class="m-card-profile__details">
                        <span class="m-card-profile__name">
                          <?php echo $rest_row['restaurant_name'];?>
                        </span>
                         
                          <?php echo $rest_row['restaurant_address'];?>
                         
                      </div>
                    </div>
                    <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                      <li class="m-nav__separator m-nav__separator--fit"></li>
                      <li class="m-nav__section m--hide">
                        <span class="m-nav__section-text">
                          Section
                        </span>
                      </li>
                       <li class="m-nav__item">
                        <a href="restaurant_view.php?restaurant_id=<?php echo $rest_row['id'];?>" class="m-nav__link">
                          <i class="m-nav__link-icon fa fa-dashboard "></i>
                          <span class="m-nav__link-text">
                            Dashboard
                          </span>
                        </a>
                      </li>
                      <li class="m-nav__item">
                        <a href="manage_menu_category.php?restaurant_id=<?php echo $rest_row['id'];?>" class="m-nav__link">
                          <i class="m-nav__link-icon flaticon-share"></i>
                          <span class="m-nav__link-text">
                            Menu Category
                          </span>
                        </a>
                      </li>
                      <li class="m-nav__item">
                        <a href="manage_menu_list.php?restaurant_id=<?php echo $rest_row['id'];?>" class="m-nav__link">
                          <i class="m-nav__link-icon flaticon-chat-1"></i>
                          <span class="m-nav__link-text">
                            Menu List
                          </span>
                        </a>
                      </li>
                      <li class="m-nav__item">
                        <a href="manage_rest_order_list.php?restaurant_id=<?php echo $rest_row['id'];?>" class="m-nav__link">
                          <i class="m-nav__link-icon fa fa-cart-arrow-down"></i>
                          <span class="m-nav__link-text">
                            Order List
                          </span>
                        </a>
                      </li> 
                    </ul>
                    <div class="m-portlet__body-separator"></div>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="m-content">
            
            <div class="m-portlet m-portlet--mobile">
              <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                      Menu Categories
                       
                    </h3>
                  </div>
                </div>
                <div class="m-portlet__head-tools">
                   
                </div>
              </div>
              <div class="m-portlet__body">

                <?php if(isset($_SESSION['msg'])){?> 
              <div class="m-portlet__body form-group m-form__group m--margin-top-10" style="padding-bottom: 5px; padding-top: 5px;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                          <?php echo $client_lang[$_SESSION['msg']] ; ?>
                </div>
              </div>
              <?php unset($_SESSION['msg']);}?> 

                <!--begin: Search Form -->

                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                  <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                      <div class="form-group m-form__group row align-items-center">
                         
                      </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                      <a href="add_menu_category.php?add=yes&restaurant_id=<?php echo $rest_row['id'];?>" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                          <i class="la la-plus"></i>
                          <span>
                            Add Category
                          </span>
                        </span>
                      </a>
                      <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                  </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="local_data">
                    <table class="table">
              <thead class="thead-default">
                <tr>                  
                   <th>Category</th>
                   <th class="cat_action_list">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
            $i=0;
            while($row=mysqli_fetch_array($result))
            {         
        ?>
                <tr scope="row">                 
                   <td><?php echo $row['category_name'];?></td>
                   <td>
                    <a href="add_menu_category.php?cat_id=<?php echo $row['cid'];?>&restaurant_id=<?php echo $rest_row['id'];?>" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">              <i class="la la-edit"></i>            </a>

                  <a href="?cat_id=<?php echo $row['cid'];?>&restaurant_id=<?php echo $rest_row['id'];?>" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" onclick="return confirm('Are you sure you want to delete this category?');">              <i class="la la-trash"></i>           </a>
                     
                </tr>
                <?php
            
            $i++;
              }
        ?> 
              </tbody>
            </table>

                </div>
            
                <!--end: Datatable -->
              </div>
            </div>
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end:: Body -->
        
<?php include("includes/footer.php");?>       
