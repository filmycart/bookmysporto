<?php
  $s_config = new Site_Config();
  if(!empty($admin->id)) {
      $s_config = $s_config->where(["admin_id" => $admin->id])->one();
  } else {
      $s_config->title = "Bookmysporto";
      $s_config->tag_line = "Bookmysporto";
      $s_config->favicon_image_name = "";
  }

  $current = basename($_SERVER["SCRIPT_FILENAME"]);
  $index = $users = $admob = $site_config = $push_notifications = $products = $categories = $settings_data = $admin_user = $events = $event_category = $event_subcategory = "";
  $payment = $attributes = $orders = $sub_categories = $venues = $contacts = $bookings = $users = $config_page = "";

  $admin_user_tree_view = $events_user_tree_view = $customer_user_tree_view = $config_page_tree_view = "";
  $admin_user_users = $admin_user_roles = $admin_user_permissions = $config_page_settings = $config_page_site = $event_events = $event_event_type = $event_event_cat = $event_event_subcat = $customer_users = "";

  if($current == "index.php") {
      $index = "active";
  } else if(($current == "admin-users.php") || ($current == "admin-user-roles.php") || ($current == "admin-user-permission.php")) {
      $admin_user = "active";
      $admin_user_tree_view = "style='display:block !important'";
      if($current == "admin-users.php") {
        $admin_user_users = "active";
      } else if($current == "admin-user-roles.php") {
        $admin_user_roles = "active";
      } else if($current == "admin-user-permission.php") {
        $admin_user_permissions = "active";
      }
  } else if(($current == "cms.php") ||($current == "cms-form.php")) {
      $cms_page = "active";
  } else if(($current == "categories.php") ||($current == "category-form.php")) {
      $categories = "active";
  } else if(($current == "sub-categories.php") ||($current == "sub-category-form.php")) {
      $sub_categories = "active";
  } else if(($current == "products.php") ||($current == "product-form.php")) {
      $products = "active";
  } else if(($current == "contacts.php") ||($current == "contacts.php")) {
      $contacts = "active";
  } else if(($current == "events.php") || ($current == "event-type.php") || ($current == "event-category.php") || ($current == "event-subcategory.php")) {
      $events = "active";
      $events_user_tree_view = "style='display:block !important'";
      if($current == "events.php") {
        $event_events = "active";
      } else if($current == "event-type.php") {
        $event_event_type = "active";
      } else if($current == "event-category.php") {
        $event_event_cat = "active";
      } else if($current == "event-subcategory.php") {
        $event_event_subcat = "active";
      }
  } else if($current == "venues.php") {
      $venues = "active";
  } else if($current == "bookings.php") {
      $bookings = "active";
  } else if(($current == "attributes.php") ||($current == "attribute-form.php")) {
      $attributes = "active";
  } else if(($current == "orders.php") || ($current == "order-detail.php") || ($current == "generate-invoice.php")) {
      $orders = "active";
  } else if($current == "payment.php") {
      $payment = "active";
  } else if($current == "users.php") {
      $users = "active";
      $customer_user_tree_view = "style='display:block !important'";
      if($current == "users.php") {
        $customer_users = "active";
      }
  } else if(($current == "sliders.php") ||($current == "slider-form.php")) {
      $sliders = "active";
  } else if(($current == "settings.php") || ($current == "site-config.php")) {
      $config_page = "active";
      $config_page_tree_view = "style='display:block !important'";
      if($current == "settings.php") {
        $config_page_settings = "active";
      } else if($current == "site-config.php") {
        $config_page_site = "active";
      }
  } else if($current == "admob.php") {
      $admob = "active";
  } else if(($current == "push-notifications.php") || $current == "push-notification-form.php") {
    $push_notifications = "active";
  }

  $admin = Session::get_session(new Admin());
  $siteConfig = Session::get_session(new Site_Config());
?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo "uploads" . DIRECTORY_SEPARATOR . $s_config->favicon_image_name; ?>" class="brand-link">
      <img src="<?php echo "uploads" . DIRECTORY_SEPARATOR . $s_config->favicon_image_name; ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=($s_config->title)?$s_config->title:''?> - <?=($s_config->tag_line)?$s_config->tag_line:''?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block"><?php echo (!empty($admin->username)?ucfirst($admin->username):'') ?></a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link <?=$config_page?>">
              <i class="nav-icon far fa fa-compass"></i>
              <p>
                Config
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?=$config_page_tree_view?>>
              <li class="nav-item">
                <a href="settings.php" class="nav-link <?=$config_page_settings?>">
                  <i class="far fa fa-wrench nav-icon"></i>
                  <p>Settings</p>
                </a>
                <a href="site-config.php" class="nav-link <?=$config_page_site?>">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Site</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="admin-users.php" class="nav-link <?=$admin_user?>">
              <i class="nav-icon far fa fa-user-circle"></i>
              <p>
                Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?=$admin_user_tree_view?>>
              <li class="nav-item">
                <a href="admin-users.php" class="nav-link <?=$admin_user_users?>">
                  <i class="far fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-user-roles.php" class="nav-link <?=$admin_user_roles?>">
                  <i class="fas fa-user-alt-slash nav-icon"></i>
                  <p>User Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-user-permission.php" class="nav-link <?=$admin_user_permissions?>">
                  <i class="far fa-copyright nav-icon"></i>
                  <p>User Permissions</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?=$users?>">
              <i class="nav-icon far fa fa-user"></i>
              <p>
                Customer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?=$customer_user_tree_view?>>
              <li class="nav-item">
                <a href="users.php" class="nav-link <?=$customer_users?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?=$events?>">
              <i class="nav-icon far fa fa-calendar-alt"></i>
              <p>
                Events
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" <?=$events_user_tree_view?>>
              <li class="nav-item">
                <a href="events.php" class="nav-link <?=$event_events?>">
                  <i class="far fa fa-calendar nav-icon"></i>
                  <p>Event</p>
                </a>
                <a href="event-type.php" class="nav-link <?=$event_event_type?>">
                  <i class="far fa fa-anchor nav-icon"></i>
                  <p>Event Type</p>
                </a>
                <a href="event-category.php" class="nav-link <?=$event_event_cat?>">
                  <i class="far fa fa-adjust nav-icon"></i>
                  <p>Event Category</p>
                </a>
                <a href="event-subcategory.php" class="nav-link <?=$event_event_subcat?>">
                  <i class="far fa fa-ad nav-icon"></i>
                  <p>Event Sub-Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="venues.php" class="nav-link <?=$venues?>">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                Venue
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="bookings.php" class="nav-link <?=$bookings?>">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Booking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="contacts.php" class="nav-link <?=$contacts?>">
              <i class="nav-icon far fa-calendar"></i>
              <p>
                Contacts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


