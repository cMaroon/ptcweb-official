<template>
    <div class="container">
        <div class="row mt-2" v-if="$gate.isSuperAdmin()">
                    <!-- <div class="container" >
                            <div class="row" > -->
                                <!-- <div class="col-12" > -->
                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                               
                                                <div class="col-2">
                                                <a href="" @click.prevent="printme" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>

                                                </div>
                                            </div>
                                            <!-- Main content -->
                                    <div class="invoice p-3 mb-3" style="background-image:url('/img/logo_ptcbw.png');  background-position:relative; background-size: auto; "  >
                                            <!-- title row -->
                                            <div class="row" >

                                        <div class="col-md-2">
                                            <img src="/img/logo.png" style="width:100px" class="img-circle elevation-2" >
                                                <!-- </h4> -->
                                                </div>
                                        <div class="col-md-10">
                                                <small class="float-right">Printed Date: {{Date.now() | setDate}}</small>

                                            <br>
                                                <h2>Pateros Technological College</h2>
                                                <h4>Class List Course : {{currstud.data[0].assoccurrid.currcourses.course_code}} of {{currstud.data[0].assoccurrid.currprograms.program_code}} {{currstud.data[0].assoccurrid.curryearlevel.title}} - {{currstud.data[0].assoccurrid.currsection.title}}</h4>
                                                
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- Table row -->
                                            <div class="row" >
                                                <div class="col-12 table-responsive" >
                                                <table class="table table-striped" >
                                                    <thead>
                                                    <tr>
                                                    <th style="padding:15px;">No.</th>
                                                    <th style="padding:15px;">Student ID</th>
                                                    <th style="padding:15px;">Fullname</th>
                                                    <th style="padding:15px;">Email</th>
                                                    <th style="padding:15px;">Student's Signature</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(currstuds, index) in orderedLastname" :key = "currstuds.id" :index="index">
                                                    <td style="width:3px; padding:15px;">{{index+1}}</td>
                                                    <td style="width:200px; padding:15px;">{{currstuds.assocformid.enr_id_num}}</td>
                                                    <td style="width:350px; padding:15px;">{{currstuds.assocformid.studinfo.lastname}} {{currstuds.assocformid.studinfo.suffixname}} , {{currstuds.assocformid.studinfo.firstname}} {{currstuds.assocformid.studinfo.middlename | firstletter}}.</td>
                                                    <td style="width:250px; padding:15px;">{{currstuds.assocformid.studinfo.cd_email}}</td>
                                                    <td style="width:250px; padding:15px;"></td>

                                                        
                                                    </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            </div>
                                            <small >College St., Brgy. Sto. Rosario-Kanluran, Pateros, Metro-Manila Telephone: 02-640-5375 / 02-640-5389</small>

                                            <!-- /.invoice --> 
                        <!-- </div> -->


                            <!-- </div> -->
                        <!-- </div> -->
        </div> 
    </div>
</template>

<script>
    export default {
        data(){
          return{
            currstud : {},
            datetoday: new Date('2011-04-11T10:20:30Z'),

          }
        },
        methods: {

            printme() {
              window.print();

          },

          loadClass(){
            // if(this.$gate.isStudent()){
                                     
                axios.get("/api/currassoc/"+this.$route.params.id).then(({data}) =>(this.currstud = data))
                .then($data=>{this.totalrecord=$data.total});
            // }


            
          }

         
        },

        created() {
           this.loadClass();
           Fire.$on('AfterCreate',() => {
               this.loadClass();
           });
          //  setInterval(() => this.loadUsers(), 15000);
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
