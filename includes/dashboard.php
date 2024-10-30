<?php wp_head(); ?>
<?php
//Domain
$domain = esc_html($_SERVER['SERVER_NAME']);

//Put global con outside
$response = wp_remote_request( "https://requested.live/api/get?domain=".esc_html($domain)."");
$body = trim(wp_remote_retrieve_body($response), "\xEF\xBB\xBF"); 
//if ( is_array( $response ) && ! is_wp_error( $response ) ) {
$body = trim($body, "\xEF\xBB\xBF"); 
$json = json_decode($body);
$status = esc_html($json->status);
$message = esc_html($json->message);
$name = esc_html($json->name); 
$your_list = esc_html($json->your_list);
$get_all_country = esc_html($json->get_all_country);
?>


<div class="wrapper" style="background-image: url('<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>images/bg_bx.jpg'); padding:23px; border-radius: 12px;">
  <!-- /.wrapper -->
  <div class="container">

    <div class="row" style="background-color: #fff; padding-left: 22px; border-radius: 32px;">

      <div class="justify-content-between align-items-center" style="padding-top: 22px;">

        <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>images/name.png">

        <?php if($status == "error"){ ?>
          <a target="_blank" href="https://requested.live/ss_register?domain=<?php echo esc_html($domain); ?>"><button type="button" class="btn btn-success">CLICK TO GET STARTED</button></a>
        <?php }else{ ?>

          <h5 class="card-title mb-0">Welcome <?php echo esc_html($name); ?></h5>

        <?php } ?>
      </div>

      <div class="card-body pb-2">
        <p><strong>We help to fetch verifiable business contacts around the world that could be beneficiary to your business in marketing campaigns and business connections.</strong></p> <div class="d-flex justify-content-around align-items-center flex-wrap mb-4">
          <div class="sessions-analytics text-center me-2" style="margin-bottom: 12px; padding: 12px; background-color: #fff; width: 150px; text-align: center; border: 1px solid #ddd; border-radius: 23px;">
            <i class="fa fa-list me-1"></i>
            <span>My Purchased Leads</span>
            <div class="align-items-center mt-2">  
              <h3 class="mb-0"><a href="<?php echo esc_url( admin_url( '/admin.php?page=my_contacts' ) ); ?>"><?php echo esc_html($your_list); ?></a></h3>
            </div>
            <a href="<?php echo esc_url( admin_url( '/admin.php?page=my_contacts' ) ); ?>"><button class="btn btn-sm btn-success">View All</button></a>
          </div>
          <div class="sessions-analytics text-center me-2" style="margin-bottom: 12px; padding: 12px; background-color: #fff; width: 150px; text-align: center; border: 1px solid #ddd; border-radius: 23px;">
            <i class="bx bx-pie-chart-alt me-1"></i>
            <span>Filter by Country</span>
            <div class="align-items-center mt-2"> 
              <h3 class="mb-0"><a target="_blank" href="https://requested.live/dashboard/countries"><?php echo esc_html($get_all_country); ?></a></h3>
            </div>
            <a target="_blank" href="https://requested.live/dashboard/countries"><button class="btn btn-sm btn-success">View All</button></a>
          </div> 
        </div> 
      </div>

      <div class="col-md-12 col-lg-12 mb-4 mb-md-0" style="margin-top: 35px;">
        <div style="background-color: #fff;">
          <br>
          <strong style="margin-left: 11px;">Countries</strong>
        </div>
      </div>
      <!-- Finance Summary -->

      <?php
      $response = wp_remote_request( "https://requested.live/api/countries");
      $body = trim(wp_remote_retrieve_body($response), "\xEF\xBB\xBF"); 
      if ( is_array( $response ) && ! is_wp_error( $response ) ) {
        $body = trim($body, "\xEF\xBB\xBF"); 
        $json = json_decode($body);
        $status = esc_html($json->status); 
        $message = esc_html($json->message); 
        if($status == "error"){
          echo "<h2 style='color:red;'>Error: esc_html($message)</h2>";
        }else{

                  //Loop through jSON response

         foreach( $json->list as $item ) {
           ?>

           <div class="sessions-analytics text-center me-2" style="margin-bottom: 12px; padding: 12px; background-color: #fff; width: 150px; text-align: center; border: 1px solid #ddd; border-radius: 23px;">
            <i class="bx bx-pie-chart-alt me-1"></i>
            <span><?php echo esc_html($item->country); ?></span>
            <div class="align-items-center mt-2"> 
              <h3 class="mb-0"><?php echo esc_html($item->all_country); ?></h3>
            </div>
            <a target="_blank" href="<?php echo esc_html($item->link); ?>"><button class="btn btn-sm btn-success">View All</button></a>
            <a target="_blank" href="https://requested.live/dashboard/buy"><button style="margin-top: 6px;" class="btn btn-sm btn-success">Buy a List</button></a>
          </div> 

          <?php
        } 
      }
    }
    ?>


    <div class="col-md-12 col-lg-12 mb-4 mb-md-0" style="margin-top: 25px;">

      <div style="background-color: #fff;">
        <br>
        <strong style="margin-left: 11px;">Sectors</strong>
      </div>
    </div>
    <!-- Finance Summary -->

    <?php
    $response = wp_remote_request( "https://requested.live/api/sectors");
    $body = trim(wp_remote_retrieve_body($response), "\xEF\xBB\xBF"); 
    if ( is_array( $response ) && ! is_wp_error( $response ) ) {
      $body = trim($body, "\xEF\xBB\xBF"); 
      $json = json_decode($body);
      $status = esc_html($json->status); 
      $message = esc_html($json->message); 
      if($status == "error"){
        echo "<h2 style='color:red;'>Error: esc_html($message)</h2>";
      }else{

                  //Loop through jSON response

       foreach( $json->list as $item ) {
         ?>

         <div class="sessions-analytics text-center me-2" style="margin-bottom: 12px; padding: 12px; background-color: #fff; width: 150px; text-align: center; border: 1px solid #ddd; border-radius: 23px;">
          <i class="bx bx-pie-chart-alt me-1"></i>
          <span><?php echo esc_html($item->sector); ?></span>
          <div class="align-items-center mt-2"> 
            <h3 class="mb-0"><?php echo esc_html($item->all_sector); ?></h3>
          </div>
          <a target="_blank" href="<?php echo esc_html($item->link); ?>"><button class="btn btn-sm btn-success">View All</button></a>
          <a target="_blank" href="https://requested.live/dashboard/buy"><button style="margin-top: 6px;" class="btn btn-sm btn-success">Buy a List</button></a>
        </div> 

        <?php
      } 
    }
  }
  ?>

</div>
<div style="width: 100%; padding: 12px; text-align: center;">
  <p>You can request any sector or country 
    <br>
    <a target="_blank" class="btn btn-success btn-lg" href="https://requested.live/dashboard/request">Request a Sector</a>
  </p>
</div>
</div>  
<br>
<small>Powered by:</small>
<br>
<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>images/logo.png">

</div> 
<?php wp_footer(); ?>