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
                <h1 class="m-0 text-primary text-bold">Manage Task</h1>
              </div><!-- /.col -->
              <div class="col-6 col-sm-6">
                <ol class="breadcrumb float-right">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item active">Manage Task</li>
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
              <div class="accordion" id="accordionExample">
                <div class="card">
                <div class="card-header bg-gradient-primary">
                  <div class="row">
                    <div class="col-2 my-auto">
                      <h4 class="card-title mb-2">Search By:</h4>
                    </div>
                    <div class="col-3 my-auto px-1">
                      <div class="form-group mb-0">
                        <input class="form-control form-control-sm mb-1" type="text" v-model="filterFrom.taskName" placeholder="Task">
                      </div>
                      <div class="form-group mb-0">
                        <input class="form-control form-control-sm mb-1" type="date" v-model="filterFrom.date" placeholder="date">
                      </div>
                    </div>
                    <div class="col-3 px-1">
                      <div class="form-group mb-0">
                        <!-- <input class="form-control form-control-sm mb-1" type="text" v-model="filterFrom.contactPerson"  placeholder="Contact Person"> -->
                        <select class="form-control form-control-sm mb-1" v-model="filterFrom.status">
                            <option value="" selected>--select--</option>
                            <option value="1">Complete</option>
                            <option value="2">Incomplete</option>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-4 pr-1">
                          <button type="submit" @click="filterData()" class="btn btn-sm btn-block bg-gradient-warning"><i class="fa fa-search"></i>Search</button>
                        </div>
                        <div class="col-4 px-1">
                          <button type="button" @click="clearForm" class="btn btn-sm btn-block bg-gradient-dark"><i class="fa fa-undo"></i></button>
                        </div>
                        <div class="col-4 pl-1">
                          <router-link to="/add-task" class="btn btn-sm btn-block bg-gradient-success" type="button"  ><i class="fa fa-plus-circle"></i> Add Tasks</router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">     
                <div class="card-body p-0">
                  <div class="table-responsive table-hover">
                    <table class="table text-nowrap mb-0">
                      <thead>
                        <tr>
                          <th>Task Id</th>
                          <th>Employee Name</th>
                          <th>Title</th>
                          <th>Description(Task)</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody class="text-md">
                        <tr v-for="(eachData,index) in allTaskList" :key="index"  v-if="allTaskList != ''">
                          <td>{{eachData.taskId}}</td>
                          <td>{{eachData.employeeName}}</td>
                          <td>{{eachData.title}}</td>
                          <td>{{eachData.description}}</td>
                          <td>{{eachData.date}}</td>
                          <td v-if="eachData.status== 1" class="btn btn-success">Complete</td>
                          <td v-if="eachData.status== 2" class="btn btn-warning">Incomplete</td>
                          
                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <i class="fas fa-wrench"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                  <a href="javascript:void(0);"  @click="getATaskDetails(eachData.id)" class="dropdown-item" data-toggle="modal" :data-target="'#edit-chamber'+index">Edit</a>
                                  <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" :data-target="'#delete-confirm'+index">Delete</a>
                              </div>
                            </div>
  
                            <!-- Edit Chamber Modal -->
                            <form v-on:submit.prevent="updateTask">
                              <div class="modal fade rms-modal" data-backdrop="static" data-keyboard="false" :id="'edit-chamber'+index">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                  <div class="modal-content text-left">
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-7 col-md-3">
                                            <div class="form-group">
                                                <input type="hidden" v-model="editForm.id" />
                                                <label class="text-grey"> Task Id <span class="text-danger">*</span></label>
                                                <input type="text" v-model="editForm.taskId" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-3 ">
                                            <div class="form-group">
                                                <label class="text-grey">Employee Name <span class="text-danger">*</span></label>
                                                <select v-model="editForm.employeeId" class="form-control form-control-sm"  required>
                                            <option v-for="(data,index) in employeeList" :key="index" :value="data.id">{{data.name}}</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-3">
                                            <div class="form-group">
                                                <label class="text-grey">Title <span class="text-danger">*</span></label>
                                                <input type="text" v-model="editForm.title" class="form-control form-control-sm" >
                                            </div>
                                        </div>
                                        <div class="col-5 col-md-2">
                                          <div class="form-group">
                                              <label class="text-grey">Description(Task) <span class="text-danger">*</span></label>
                                              <textarea name="" id="" rows="3" v-model="editForm.description" class="form-control form-control-sm" required></textarea>
                                          </div>
                                        </div>
                                        <div class="col-7 col-md-3">
                                            <div class="form-group">
                                                <label class="text-grey">Date <span class="text-danger">*</span></label>
                                                <input type="date" v-model="editForm.date" class="form-control form-control-sm" >
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-3 my-auto">
                                          <div class="form-group">
                                            <label class="text-grey">Status</label>
                                            <!-- <input type="text" v-model="editForm.contactPerson" class="form-control form-control-sm"> -->
                                            <select class="form-control form-control-sm" v-model="editForm.status" required>
                                                <option value="" selected>-- select --</option>
                                                <option value="1">Complete</option>
                                                <option value="2">Incomplete</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-4 offset-2 col-md-2 my-auto">
                                          <button class="btn bg-gradient-danger btn-sm btn-block mt-2" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Discard</button>
                                        </div>
                                        <div class="col-4 col-md-2 my-auto">
                                          <button class="btn bg-gradient-primary btn-sm btn-block mt-2" type="submit"><i class="fa fa-check-circle"></i> Save Changes</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                            <!-- Edit Chamber Modal -->
  
                            <!-- Delete Confirm Modal -->
                            <div class="modal fade rms-modal" data-backdrop="static" data-keyboard="false" :id="'delete-confirm'+index" tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-12 mb-3">
                                        <button class="btn bg-gradient-danger btn-block btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> No, Cancel</button>
                                      </div>
                                      <div class="col-12">
                                        <button @click="delTask(eachData.id)" class="btn bg-gradient-primary btn-block btn-sm" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Yes, Delete</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Delete Confirm Modal -->
  
                          </td>
                        </tr>
                        <tr v-else>
                          <td colspan="13" style="text-align:center; color:red;font-size: 30px;">
                            <h2 style="margin-top:40px;">No Data Found !</h2>
                          </td>
                      </tr>
                      </tbody>
                    </table>
                    <div class="p-5" v-if="searchPagination == false" >
                    <pagination v-if="pagination.last_page > 1"
                        :pagination="pagination"
                        :offset="10"
                        @paginate="getAllTask()">
                    </pagination>
                  </div>
                  <div class="p-5" v-else>
                    <pagination v-if="pagination.last_page > 1"
                        :pagination="pagination"
                        :offset="10"
                        @paginate="filterData()">
                    </pagination>
                  </div>
                  </div>
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
  import Sidebar from './layout/sidebar.vue';
  import Navbar from './layout/navbar.vue';
  import Api    from '../src/Api.js';
  import Chowkidar from '../src/Chowkidar.js'
  import Pagination from '../src/Pagination.vue'
  
  export default {
    components:{
      'sidebar':Sidebar,
      'navbar':Navbar,
      'pagination':Pagination
    },
    data(){
      return{
        pagination:{
        current_page:1,
        },
  
        searchPagination : false,
        isLoading : false,
        employeeList:{},
  
        filterFrom:{
            taskName:'',
            date:'',
            status:'',
        },
  
        editForm:{
            taskId:'',
            employeeId :'',
            title:'',
            description  :'',
            status : '',
            id : '',
            date:''
        },
  
        allTaskList:{},
      }
    },
    methods:{
  
      resetForm(){
        this.editForm={
            taskId:'',
            employeeId :'',
            title:'',
            description  :'',
            status : '',
            id : '',
            date:''
        }
      },
  
        updateTask(){
          Api().post('/update-task/',this.editForm)
            .then(response =>{
              if(response.data['success'] == true){
                this.getAllTask();
                this.$swal({
                  icon: 'success',
                  title: ' '+response.data['msg'],
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 4000
                });
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
  
        delTask(taskId){
            Api().get('/delete-task/'+taskId)
            .then(response =>{
                if(response.data['success'] == true){
                this.getAllTask();
                this.$swal({
                    icon: 'warning',
                    title: ' '+response.data['msg'],
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000
                });
                }
            })
        },
  
        getATaskDetails(taskId){
            Api().get('/get-a-task-details/'+taskId)
            .then(response =>{
                this.editForm ={
                    id:response.data.id,
                    employeeId: response.data.employeeId,
                    title : response.data.title ,
                    description: response.data.description,
                    status: response.data.status,
                    taskId: response.data.taskId,
                    date: response.data.date,
                }
            })
        },
  
        getAllTask(){
            this.searchPagination = false;
            this.isLoading = true;
            Api().get('/all-task-list?page='+this.pagination.current_page)
            .then(response =>{
                if(response.data == null)
                {
                    this.isLoading = true;
                }
                else
                { 
                    this.isLoading  = false;
                    this.pagination = response.data.meta;
                    this.allTaskList = response.data.data;
                }
            })
        },
        
        filterData(){
            this.searchPagination = true;
            Api().post('/filter-task?page='+this.pagination.current_page,this.filterFrom)
            .then(response =>{
                if(response.data == null)
                {
                this.isLoading = true;
                }
                else
                { 
                this.isLoading  = false;
                this.pagination = response.data.meta;
                this.allTaskList = response.data.data;
                }
            })
        },
            
        clearForm(){
            this.filterFrom
            this.filterFrom.taskName   = '';
            this.filterFrom.date     = '';
            this.filterFrom.status = '';
            this.getAllTask();
        },

        getEmployeeList(){
          Api().get('/only-employee-name-list')
          .then(response =>{
              this.employeeList = response.data;
        })
      },
  
    },
    created(){
      if(Chowkidar() == 'web')
      {
        this.getAllTask();
        this.getEmployeeList();
      }else{
        this.$router.push('/login');
      }
    }
  }
  </script> 