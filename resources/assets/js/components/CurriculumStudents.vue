<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
            <template v-if="currstud.data">

                <h3 class="card-title" >Class List <br>Course : {{currstud.data[0].assoccurrid.currcourses.course_code}} of {{currstud.data[0].assoccurrid.currprograms.program_code}} {{currstud.data[0].assoccurrid.curryearlevel.title}} - {{currstud.data[0].assoccurrid.currsection.title}} </h3>
            </template>
                <div class="card-tools">
                    <router-link :to="{name: 'printclass', params:{id: this.$route.params.id}}" >
                            Print Preview  <i class="fas fa-print icon-green"></i>
                        </router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>No.</th>
                    <th>Student ID</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Student's Signature</th>
                  </tr>
                  <tr v-for="(currstuds, index) in orderedLastname" :key = "currstuds.id" :index="index">
                    <td>{{index+1}}</td>
                    <td>{{currstuds.assocformid.enr_id_num}}</td>
                    <td>{{currstuds.assocformid.studinfo.lastname}} {{currstuds.assocformid.studinfo.suffixname}} , {{currstuds.assocformid.studinfo.firstname}} {{currstuds.assocformid.studinfo.middlename | firstletter}}. </td>
                    <td>{{currstuds.assocformid.studinfo.cd_email}}</td>
                    <td></td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Students in this Course : {{totalrecord}}</p>

                  
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isSuperAdmin()">
            <not-found></not-found>
        </div>


    </div>
</template>

<script>
    export default {
        data(){
          return{
            editmode: false,
            currstud : {},
            totalrecord:'',

          }
        },
        methods: {
         

          loadEnrollment(){
            // if(this.$gate.isStudent()){
                // axios.get("/api/curriculum").then(({data}) =>(this.curriculum = data))
                // axios.get("/api/courses").then(({data}) =>(this.courses = data))
                // axios.get("/api/yearlevel").then(({data}) =>(this.yearlevel = data))                
                // axios.get("/api/semester").then(({data}) =>(this.semester = data))                                      
                axios.get("/api/currassoc/"+this.$route.params.id).then(({data}) =>(this.currstud = data))
                .then($data=>{this.totalrecord=$data.total});
            // }

          },


        },
        created() {

           this.loadEnrollment();
           Fire.$on('AfterCreate',() => {
               this.loadEnrollment();
           });
        },
        computed: {
            orderedLastname: function(){
                return _.orderBy(this.currstud.data,'assocformid.studinfo.lastname')
            }
        },
        filters: {
            firstletter: function(value){
                if(!value) return ''
                value = value.toString()
                return value.charAt(0)
            }
        }
    }
</script>
