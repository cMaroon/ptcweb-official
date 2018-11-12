@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                          <!-- title row -->
                          <div class="row">
                            <div class="col-12">
                              <h4><img src="./img/logo_ptc.png" alt="PTC Logo" class="brand-image"
                                style="height:200px; width:40px; ">
                                 Pateros Technological College
                                 <br>
                                 <small>Certificate of Registration</small>
                              </h4>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-8 invoice-col">
                              Student Information
                              <address>
                                <strong>Student ID Number: </strong>
                                  454546d45as5d<br>
                                <strong>Name: </strong>
                                Surname, Firstname Middlename<br>
                                <strong>Address: </strong>
                                Address dito<br>
                              </address>
                            </div>

                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                              <b>Form ID# 007612</b><br>
                              <b>Program Code: </b> BSIT<br>
                              <b>Year and Section</b> First Year - A<br>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                            <div class="col-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>Course Code</th>
                                  <th>Description</th>
                                  <th>Unit</th>
                                  <th>Lecture</th>
                                  <th>Laboratory</th>
                                  <th>Day</th>
                                  <th>Time</th>
                                  <th>Room</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                               
                                </tbody>
                              </table>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <div class="col-4">
                              <p class="lead">Semestral Fees:</p>
                              <div class="col-12">    
                                  <div class="table-responsive">
                                    <table class="table">
                                      <tbody><tr>
                                        <th style="width:70%">Tuition Fee: </th>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <th>Registration Fee: </th>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <th>Library Fee: </th>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <th>Medical Fee: </th>
                                        <td></td>
                                      </tr>
                                      <tr>
                                          <th>Cultural: </th>
                                          <td></td>
                                        </tr>

                                    </tbody></table>
                                  </div>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <p class="lead">&nbsp;</p>

                                <div class="table-responsive">
                                  <table class="table">
                                    <tbody><tr>
                                      <th style="width:50%">
                                          Athletic:</th>
                                      <td></td>
                                    </tr>
                                      <tr>
                                          <th>Book Rental: </th>
                                          <td></td>
                                        </tr>
                                        <tr>
                                            <th>Laboratory: </th>
                                            <td></td>
                                          </tr>
                                          <tr>
                                              <th>Penalty: </th>
                                              <td></td>
                                            </tr>
                                            <tr>
                                                <th>Others: </th>
                                                <td></td>
                                              </tr>
  
                                  </tbody></table>
                                </div>
                              </div>
                            <div class="col-4">
                                <p class="lead">&nbsp;</p>

                              <div class="table-responsive">
                                <table class="table">
                                  <tbody><tr>
                                    <th style="width:50%">
                                      Assed by: </th>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <th>Assessed By:  </th>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <th>College Registrar: </th>
                                    <td></td>
                                  </tr>

                                </tbody></table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-12">

                              <a href="" @click.prevent="printme" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                              

                            </div>
                          </div>

                        </div>
                        <!-- /.invoice -->
                      </div>


        </div>
    </div>


@endsection
