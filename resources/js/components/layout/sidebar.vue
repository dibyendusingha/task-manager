<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom elevation-4 sidebar-dark-primary">
    <!-- Brand Logo -->
    <a  data-widget="pushmenu" href="javascript:void(0);" role="button" class="brand-link" style=" background: rgb(5,114,239); background: linear-gradient(180deg, rgba(5,114,239,1) 13%, rgba(1,60,127,1) 100%);">
      <h6 class="brand-text font-weight-bold">Task Manager</h6>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-overflow os-host-overflow-y os-theme-light">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item shadow-sm">
            <router-link to="/" class="nav-link active" v-if="mainMenu == 'dashboard'">
              <i class="fas fa-home nav-icon"></i>
              <p>Dashboard</p>
            </router-link>
            <router-link to="/" class="nav-link" v-else>
              <i class="fas fa-home nav-icon"></i>
              <p>Dashboard</p>
            </router-link>
          </li>
          <li class="nav-item shadow-sm" v-if="this.roleid == 2">
            <router-link to="/user-task" class="nav-link active" v-if="mainMenu == 'doc'">
              <i class="fas fa-user-nurse nav-icon"></i>
              <p>User Task</p>
            </router-link>
            <router-link to="/user-task" class="nav-link" v-else>
              <i class="fas fa-user-nurse nav-icon"></i>
              <p>User Task</p>
            </router-link>
          </li>
          
          <li class="nav-item shadow-sm" v-if="this.roleid == 1 ">
            <router-link to="/manage-task" class="nav-link active" v-if="mainMenu == 'doc'">
              <i class="fas fa-user-nurse nav-icon"></i>
              <p>Manage Task</p>
            </router-link>
            <router-link to="/manage-task" class="nav-link" v-else>
              <i class="fas fa-user-nurse nav-icon"></i>
              <p>Manage Task</p>
            </router-link>
          </li>
          <li class="nav-item shadow-sm" v-if=" this.roleid == 1">
            <router-link to="/manage-employee" class="nav-link active" v-if="mainMenu == 'chamer'">
              <i class="fas fa-hospital nav-icon"></i>
              <p>Manage Employee</p>
            </router-link>
            <router-link to="/manage-employee" class="nav-link" v-else>
              <i class="fas fa-hospital nav-icon"></i>
              <p>Manage Employee</p>
            </router-link>
          </li>
      
          <li class="nav-item text-center">
            <button type="button" class="btn bg-gradient-primary my-2" data-widget="pushmenu">
              <i class="fa fa-chevron-left fa-2x"></i>
            </button>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Main Sidebar Container -->
</template>
<script>

export default {
  mainMenu:'',

  props:{
    mainMenu: String,
  },

  created(){
     
    this.phone  = localStorage.getItem('contactno');
    this.roleid = localStorage.getItem('roleid');
  
  }

  
}
</script>
