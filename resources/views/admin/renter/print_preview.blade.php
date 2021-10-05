<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{rand()}}</title>

  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('admin/custom_font.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  
  <style>

    @page { size: auto;  margin: 0mm; }
            .table td, .table th {
                padding: .25rem;
                font-size: 13px;
            }
            @media print
            {
                .noprint {display:none;}
            }

    
    .cx{
       font-family:Arial, Helvetica, sans-serif; 
       font-size:14px;
    }
  </style>

  

</head>

<body class="theme-blue">
  <div class="container-fluid">
            <div class="container">

          <div class="noprint">
                    <div class="row" style="margin: 20px 0;">
                        <div class="col-md-12">
                            <button onclick="window.print()"  class="btn btn-info m-2 float-right"><i class="icon-printer btn_add"></i> Print</button>
                        </div>
                    </div>
                </div>

 <section>
  
<div class="row clearfix">
          <div class="col-lg-12">
              
            <div class="card m-3">
                    <div class="header text-center mb-5">
                        <h3 style="margin-top: 120px;" class="font_s text-center text-info ">Payment Details of {{date('F, Y', strtotime($rent_pay_history->paid_for_month))}}</h3>
                        <span style="font-size: 15px; line-height: 40px; font-weight: bold; color: black;" class="pull-right ">Date :- {{ date("F j, Y") }}</span>
                    </div>

        
            <div class="body">
              <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 16px; font-weight: bold;">Renter Name</th>
                                            <th style="font-size: 16px; font-weight: bold;">{{($rent_pay_history->renter)? $rent_pay_history->renter['renter_name'] : NULL}}</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td>Apartment Name</td>
                                            <td><span class="text-info">{{($rent_pay_history->apartments)?  $rent_pay_history->apartments['apartment_name'] : NULL}}</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Flat Name</td>
                                            <td><span class="text-info">{{($rent_pay_history->flat)? $rent_pay_history->flat['flat_name'] : NULL}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Total Recieved Amount(Collected)</td>
                                            <td><strong><span class="text-success">{{$rent_pay_history->paid_amount}}</span></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Rent Submission Date</td>
                                            <td><span class="text-info">{{date('F j, Y',strtotime($rent_pay_history->payment_date))}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Note</td>
                                            <td><span class="text-info">{{$rent_pay_history->comments}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

              
              <hr>
           


            



<div class="header">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              
       <table class="table table-bordered table-condensed" style="background: linear-gradient(to right, #ece9e6, #ece9e6);">
        
            <tbody>
              <tr>
                
                <td >Flat Rent:</td>
                <td>{{$rent_pay_history->flat_rent_amount}}</td>
              </tr>
              <tr>
                
                <td>Utility Bill:</td>
                <td>{{$rent_pay_history->utility_bill_amount}}</td>
                
              </tr>
              <tr>
                
                <td>Additional Charge:</td>
                <td>{{$rent_pay_history->additional}}</td>
                
              </tr>
              <tr>
                
                <td>Discount:</td>
                <td>{{$rent_pay_history->discount}}</td>
                
              </tr>
              <tr>
                
                <td>Deduct from Advance:</td>
                <td><span class="text-danger">{{$rent_pay_history->paid_from_advance}}</span></td>
                
              </tr>
              <tr>
                
                <td><strong>Total Rent Recieved</strong> </td>
                <td><strong><span class="text-success">{{$rent_pay_history->paid_amount}}</span></strong></td>
                
              </tr>
              <tr>
                
                <td><strong>Due Amount</strong> </td>
                <td><strong><span class="text-danger">{{$rent_pay_history->due_amount}}</span></strong></td>
              </tr>
            </tbody>
        </table>   
                                                                     
       </div>
     </div>

                 <div class="row p-1">
                            <div class="col-md-12">
                                <?php
                                $number = $rent_pay_history->paid_amount;
                                $no = round($number);
                                $point = round($number - $no, 2) * 100;
                                $hundred = null;
                                $digits_1 = strlen($no);
                                $i = 0;
                                $str = array();
                                $words = array('0' => '', '1' => 'one', '2' => 'two',
                                    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                    '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                    '13' => 'thirteen', '14' => 'fourteen',
                                    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                    '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
                                    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                    '60' => 'sixty', '70' => 'seventy',
                                    '80' => 'eighty', '90' => 'ninety');
                                $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                                while ($i < $digits_1) {
                                    $divider = ($i == 2) ? 10 : 100;
                                    $number = floor($no % $divider);
                                    $no = floor($no / $divider);
                                    $i += ($divider == 10) ? 1 : 2;
                                    if ($number) {
                                        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                        $str [] = ($number < 21) ? $words[$number] .
                                                " " . $digits[$counter] . $plural . " " . $hundred :
                                                $words[floor($number / 10) * 10]
                                                . " " . $words[$number % 10] . " "
                                                . $digits[$counter] . $plural . " " . $hundred;
                                    } else
                                        $str[] = null;
                                }
                                $str = array_reverse($str);
                                $result = implode('', $str);
                                ?>
                                @if($rent_pay_history->paid_amount < 0)
                                <p style="font-weight: bold; padding-top: 5px; padding-left: 5px;">{{ "[ In word: BDT (-)" . ucfirst($result) . "taka only ]" }}</p>
                                @else
                                <p style="font-weight: bold; padding-top: 5px; padding-left: 5px;">{{ "[ In word: BDT " . ucfirst($result) . "taka only ]" }}</p>
                                @endif
                                <p style="padding-top: 30px; padding-left: 5px; ">If you have any further queries regarding the above, please feel free to contact us at your convenience.</p>

                                <p style="padding-top: 5px; padding-left: 5px;">Thanks, and Warmest Regards</p>

                              </div>
                            </div>

                        <div class="row" style="margin-top: 50px; padding-left: 10px; padding-bottom: 20px;">
                            <div class="col-sm-6">
                                <p class="pull-left" style="border-top: 1px dotted #000; font-weight: bold; width: 200px;">Renter Signature</p>
                            </div>
                            
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </body>
        </html>





