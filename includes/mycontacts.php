<?php wp_head(); ?>
<?php
//Domain
$domain = $_SERVER['SERVER_NAME'];

//Put global con outside
$response = wp_remote_request( "https://requested.live/api/get?domain=".esc_html($domain)."");
$body = trim(wp_remote_retrieve_body($response), "\xEF\xBB\xBF"); 
//if ( is_array( $response ) && ! is_wp_error( $response ) ) {
$body = trim($body, "\xEF\xBB\xBF"); 
$json = json_decode($body);
$status = esc_html($json->status);
$acctid = esc_html($json->acctid);
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

        <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ); ?>images/name2.png">

      <?php if($status == "error"){ ?>
        <a target="_blank" href="https://requested.live/ss_register?domain=<?php echo esc_html($domain); ?>"><button type="button" class="btn btn-success">CLICK TO GET STARTED</button></a>
      <?php }else{ ?>

        <a target="_blank" href="https://requested.live/dashboard/buy"><button type="button" class="btn btn-success btn-lg">Buy More List</button></a>
        <h5 class="card-title mb-0">My Purchased Contacts (<?php echo esc_html($your_list); ?>)</h5>
        <br>
      <?php } ?>
    </div>



    <div class="table-responsive" style="padding-bottom: 23px;">

      <table id="example" class="nowrap table table-stripped" style="width:100%">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Telephone</th> 
            <th>Sector</th> 
            <th>State/Prov.</th>
            <th>Country</th>
            <th>Added Date</th>
          </tr>
        </thead>
        <tbody> 
         <?php
         $response = wp_remote_request( "https://requested.live/api/mycontacts?acctid=".esc_html($acctid)."");
         $body = trim(wp_remote_retrieve_body($response), "\xEF\xBB\xBF"); 
         if ( is_array( $response ) && ! is_wp_error( $response ) ) {
          $body = trim($body, "\xEF\xBB\xBF"); 
          $json = json_decode($body);
          $tel = esc_html($json->tel); 
          $country = esc_html($json->country);
          $state = esc_html($json->state);
          $date = esc_html($json->date);
          $message = esc_html($json->message);
          if($status == "error"){
            echo "<h2 style='color:red;'>".esc_html($message)."</h2>";
          }else{

                  //Loop through jSON response
            if (is_array($json->list) || is_object($json->list)){
             foreach( $json->list as $item ) {
               ?>
               <tr>
                <td><div class="bg-success" style="width: 30px;">&nbsp;</div></td>
                <td style="font-weight: bold;"><?php echo esc_html($item->tel); ?></td>
                <td><?php echo esc_html($item->sector); ?></td> 
                <td><?php echo esc_html($item->state); ?></td>
                <td><?php echo esc_html($item->country); ?></td>
                <td><?php echo esc_html($item->date); ?></td>                
              </tr> 

              <?php
            }
          }
        }
      }
      ?>

    </tbody>
  </table>
</div>

<script type="text/javascript">
 jQuery(document).ready(function($){
  $('#example').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  } );
} );
</script>

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