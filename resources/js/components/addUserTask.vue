<template>
    <div class="wrapper">
      <navbar/>
      <sidebar mainMenu='chamber'/>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-6 col-sm-6">
                <h1 class="m-0 text-primary text-bold">Add Task</h1>
              </div><!-- /.col -->
              <div class="col-6 col-sm-6">
                <ol class="breadcrumb float-right">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item active">Add Task</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h6 class="mb-0">Type Task Info</h6>
                </div>
                <div class="card-body p-3">
                <form v-on:submit.prevent="saveTask"> 
                  <div class="row">
                    <div class="col-6 col-md-3 my-auto">
                        <div class="form-group">
                            <label class="text-grey">Employee Name <span class="text-danger">*</span></label>
                            <!-- <input type="text" v-model="form.name" class="form-control form-control-sm" required> -->
                            <select v-model="form.employeeId" class="form-control form-control-sm"  required>
                          <option v-for="(data,index) in employeeList" :key="index" :value="data.id">{{data.name}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 my-auto">
                        <div class="form-group">
                            <label class="text-grey">Title <span class="text-danger">*</span></label>
                            <input type="text" v-model="form.title" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 my-auto">
                        <div class="form-group">
                            <label class="text-grey">Description (Task) <span class="text-danger">*</span></label>
                            <!-- <input type="text" v-model="form.contactNo" class="form-control form-control-sm" required> -->
                            <textarea v-model="form.description" class="form-control form-control-sm" name="" id="" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 my-auto">
                        <div class="form-group">
                            <label class="text-grey">Date <span class="text-danger">*</span></label>
                            <input type="date" v-model="form.date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-2 my-auto">
                      <div class="form-group">
                          <label class="text-grey">Status <span class="text-danger">*</span></label>
                          <!-- <input type="text" v-model="form.contactNo" class="form-control form-control-sm" required> -->
                          <select class="form-control form-control-sm" v-model="form.status" required>
                            <option value="" selected>-- select --</option>
                            <option value="1">Complete</option>
                            <option value="2">Incomplete</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-4 offset-2 col-md-2 my-auto">
                      <button class="btn bg-gradient-danger btn-sm btn-block mt-2" type="button" @click="resetForm"><i class="fa fa-times-circle"></i> Discard</button>
                    </div>
                    <div class="col-4 col-md-2 my-auto">
                      <button class="btn bg-gradient-primary btn-sm btn-block mt-2" type="submit"><i class="fa fa-check-circle"></i> Save Changes</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
  
      
    </div>
  </template>
  
  <script>
    import Sidebar from './layout/sidebar.vue'
    import Navbar from './layout/navbar.vue'
    import Api    from '../src/Api.js';
    import Chowkidar from '../src/Chowkidar.js'
  
  export default {
    components:{
      'sidebar':Sidebar,
      'navbar':Navbar
    },
    
    data(){
      return{

        form:{
          employeeId :'',
          title:'',
          description  :'',
          status : '',
          date:''
        },
        employeeList:{},

      }
    },
    methods:{
  
      resetForm(){
        this.form = {
            employeeId :'',
            title:'',
            description  :'',
            status : ''
        }
      },
  
      saveTask(){
          Api().post('/add-task',this.form)
            .then(response =>{
              if(response.data['success'] == true){
                
                this.$swal({
                  icon: 'success',
                  title: ' '+response.data['msg'],
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 4000
                });
                this.resetForm()
              }else{
                this.$swal({
                  icon: 'error',
                  title: ' '+response.data['msg'],
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 4000
                });
              }
            })
        
      },

      getEmployeeList(){
        this.phone  = localStorage.getItem('contactno');
          Api().get('/user-only-employee-name-list/'+this.phone)
          .then(response =>{
              this.employeeList = response.data;
        })
        },
    },
    created(){
      if(Chowkidar() == 'web')
      {
        this.getEmployeeList();

      }else{
        this.$router.push('/login');
      }
    }
  }
  </script>