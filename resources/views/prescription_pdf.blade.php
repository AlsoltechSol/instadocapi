<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>mfine</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/index.css'>
    <!--for bootstarp ---->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
   <header>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 pt-5" >
                        <img src="" height="80px" width="140px" style="margin-left: 20px;">
                    </div>
                    <div class="col-md-6 pt-4">
                        <p class="font1 text-right">7865958508<br>
                            Biman Saha C/o- Pradhan Mantri Bhartiya<br> Janaushadhi Kendra Near Madarihat Rural<br> Hospital entry gate Vill- Aswaninagar 2 no. <br>Ward P.O+P.S- Madarihat Dist -Alipurduar<br> West Bengal- 735220</p>
                    </div>
                </div>
                <!--<hr class="b1">-->  
                <div class="row border-top border-bottom border-dark m-2">
                    <div class="col-md-6">
                        <p class="font1">Name: <span>Suraj Jeswara</span><br>
                        Age/Gender: <span>26y/Male</span></b>
                    </div>
                    <div class="col-md-6 text-right p-0">
                        <p class="font1">Date: <span> {{ \Carbon\Carbon::today()->format('d/m/Y') }}</span></p>
                    </div>
                </div>
                <!--<hr class="b1">-->
                <div class="row m-2">
                    <div class="col-md-12">
                        <p class="font1"> Dr. Naga Mahesh Boya (Physician)</p>
                    </div>
                </div>
            </div>
        </section>
   </header>
   <!--header end-->

   <section>
        <div class="container-fluid">
            <div class="row m-2 mt-5">
                <div class="col-md-12">
                    <div>
                        <h5 class="font-weight-bold head1">Chief Complaints</h5>
                        <p class="font1">{{$pres_pdf[0]->chief_complaints}}</p>
                    </div>
                    <div>
                        <h5 class="font-weight-bold head1">Allergies</h5>
                        <ul class="font1">
                            <li>{{$pres_pdf[0]->allergies}}</li>
                            <!-- <li>No food allergy</li>
                            <li>Does not have dust allergy</li> -->
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-weight-bold head1">Diagnosis</h5>
                        <ul class="font1">
                            <li>{{$pres_pdf[0]->diagnosis}}</li>
                            <!-- <li>Vitamin B12 deficiency (suspected)</li>
                            <li>Hyperlipidemia (suspected)</li> -->
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-weight-bold head1">Prescription</h5>
                        <table>
                        <thead>

                            <tr>
                                <th>Sl.</th>
                                <th>Medicine Name</th>
                                <th>Dosage</th>
                                <th>Freq.</th>
                                <th>Duration</th>
                                <th>Instructions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pres_pdf as $pdf)
                            <tr class="font1">
                                <td>{{$loop->index+1}}</td>
                                <td>{{$pdf->prescription_medicine_name}}</td>
                                <td>{{$pdf->prescription_medicine_dosage}}</td>
                                <td>{{$pdf->prescription_medicine_frequency}}</td>
                                <td>{{$pdf->prescription_medicine_duration}}</td>
                                <td>{{$pdf->prescription_medicine_instructions}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                            <!-- <tr class="font1">
                                <td>1.</td>
                                <td>D-RISE 60K CAPS <br>
                                    Cholecalciferol 60000IU
                                </td>
                                <td>1 tab</td>
                                <td>OnceEvery 1 week</td>
                                <td>8 weeks</td>
                                <td>After Food</td>
                            </tr>
                            <tr class="font1">
                                <td>2.</td>
                                <td>NEUROBION FORTE TAB<br>
                                    calcium pantothenate 50mg, nicotinamide<br>
                                    45mg, riboflavin 10mg, thiamine mononitrate<br>
                                    10mg, pyridoxine hydrochloride 3mg ... and 1<br>
                                    Others
                                    </td>
                                <td>1 tab</td>
                                <td>1-0-0</td>
                                <td>3 months </td>
                                <td>After Food</td>
                            </tr>
                            <tr class="font1">
                                <td>3.</td>
                                <td>A TO Z NS TAB
                                    vitamin C 40mg, vitamin B3 16mg, vitamin E<br>
                                    15mg, zinc 10mg, pinus pinaster bark extract<br>
                                    10mg ... and 13 Others</td>
                                <td>1 tab</td>
                                <td>1-0-0</td>
                                <td>3 months</td>
                                <td>After Food</td> -->
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   </section>
   <section>
    <div class = "container-fluid">
        <div class="row m-2 mt-5">
            <div class="col-md-12">
                    <h5 class="font-weight-bold head1">General Advice</h5>

                    {{$pres_pdf[0]->general_advice}}
                <!-- <ul  class="font1">
                    <li>
                        Diet:-
                        <ol>
                            <li>Reduce overall calorie intake</li>
                            <li>Prefer Fibre rich foods - banana, apples pears, beans, legumes etc</li>
                            <li>Some protein needs to be at lunch breakfast and dinner. You can choose milk, curd, dal, channa, rajma.</li>
                            <li>Consume omega 3 fatty acid rich foods like seafood, chia seeds and walnuts</li>
                            <li>Use cold pressed oils instead of refined oils for cooking</li>
                            <li> Eat 2-3 fresh and seasonal fruits a day.</li>
                            <li>Add vegetables and salad in lunch and Dinner.</li>
                            <li>Avoid chocolates, chips, cakes.</li>
                            <li>Some protein needs to be at lunch breakfast and dinner. You can choose milk, curd, dal, channa, rajma.</li>
                            <li>Avoid refined oils, sugars (reduce oily food in diet), deep fried items and foods from outside.</li>
                            <li>Avoid ice creams and sweets.</li>
                            <li>Avoid excess jaggery and sugar intake</li>
                        </ol>   
                        <div class="pt-4">
                            <p>Follow up :-<br>
                            Review with Fasting Lipid Profile/ Liver Function Test after 3 months<br>
                            Open a new case with mfine dietitian - in view of diet plan to lowering the body fats and<br>
                            follow diet chart.</p>
                        </div>
                        </li>
                        <li>DIETARY ADVICE:<br>
                        Include these foods in your diet.
                        <ol type="a">
                            <li>
                                Veg Sources- Fortified Nutritional Yeast, Milk and Dairy Products like Cheese, yogurt,<br>
                                fortified plant based milk</li>
                            <li>
                                Non Veg Sources- Fish, Animal Meat, Eggs.
                            </li>
                        </ol>
                        <div class="pt-4">
                            <p>RED FLAG SIGNS:Consult a doctor if onset of any of these symptoms<br>
                                - a sore and red tongue (glossitis)<br>
                                - non healing mouth ulcers.<br>
                                - pins and needles (paraesthesia)<br>
                                - changes in the way that you walk and move around.<br>
                                - disturbed vision.<br>
                                - irritability.<br>
                            </p>
                        </div>
                    </li>
                    <li>
                        <ol>
                            <li> Maintain a healthy lifestyle</li>
                            <li>Exercise regularly for 30-40 minutes / day</li>
                            <li> Eat a balanced diet with low sugars and low fat diet</li>
                            <li>Avoid stress and have 6-8 hours regular sleep.</li>
                            <li>Drink 3-4 litres of fluids everyday</li>
                            <li>Review as and when required.</li>
                        </ol> 
                        <div class="pt-4">
                            <p>
                                - Eat 2-3 fresh and seasonal fruits a day.<br>
                                - Add vegetables and salad in lunch and Dinner. <br>
                                - Avoid chocolates, chips, cakes.<br>
                                - Some protein needs to be at lunch breakfast and dinner. You can choose milk, curd, dal,
                                channa, rajma.<br>
                                - Avoid all fried foods and foods from outside.<br>
                                - Avoid ice creams and sweets.<br>
                                - Avoid excess jaggery and sugar intake.<br>
                                - Avoid alcohol intake and smoking, if any<br>
                                - Include fresh fruits and vegetables in your diet.<br>
                            </p>
                        </div>
                    </li>
                    <li>
                       <p> - Follow the Diabetic Diet. Active and healthy lifestyle to maintain Blood Glucose within range<br>
                            - Eye Examination once in 6 months<br>
                            - Examine your foot regularly and get it checked by your physician twice a year to detect any<br>
                            injuries because in diabetes there are chances of decreased sensation in peripheries and<br>
                            injuries go unnoticed.<br>
                            - Blood Pressure measurement once every month<br>
                            - Kindly review with FBS and PPBS reports after 1 month<br>
                        </p><br>
                        <p>Key points to control your SUGAR levels</p>
                        <ol>
                            <li>
                                Regularize your sleep and Maintain minimum 6-8 hours of sleep.
                            </li>
                            <li>Choose foods that are lower in calories, saturated fat, trans fat, sugar, and salt like whole<br>
                                cooked cereals, meat, eggs, pulses (like dal, rajma, etc) and milk products. Reduce<br>
                                carbohydrates like Rice/Ragi/Wheat/Oats</li>
                            <li>Exercise 3kms or 30 mins of walking. Do brisk walk, cycle, or swim for about 30 minutes a<br>day.</li>
                            <li>Eat only 3 meal a day. Eat fruits and Vegetables along with meals</li>
                            <li>Avoid refined oils and refined sugars. Use cold pressed oils instead.</li>
                            <li>Plenty of fluids 3-4 litres/day</li>
                            <li>Eat foods with high fiber like fruits with outer skin, beans, brown rice, broccoli, spinach,<br>
                                whole grain cereal products</li>
                            <li>Practice yoga and meditation as it helps to reduce stress</li>
                        </ol>
                    </li>
                    <br>
                <li>
                <ol>
                    <li>Use iodized salt in food preparation. Iodine is an essential trace mineral that your body<br>
                    needs in order to make thyroid hormones.</li>
                    <li>Have high fibre diet like carrots,cucumber and beet root salad</li>
                    <li>Avoid food like brocolli, cauliflower and soya. They contain natural chemicals that may<br>
                    interfere with thyroid hormone synthesis</li>
                    <li>Eat healthy and nutritious foods</li>
                    <li>Exercise regularly brisk walking for 40 mins / day</li>
                    <li>Practice yoga, meditation as it helps to reduce stress, and some aerobic exercises to keep,<br>
                    yourself fit.</li>
                </ol>
            </li>
                </ul> -->
            </div>
        </div> 
        <div class="row m-3 pt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bolder">Dr. Naga Mahesh Boya</h4>  
            <h6>MBBS</h6>
            <h6>Registration No: APMC/102565</h6>
            {{$pres_pdf[0]->mobile}}
        
           

        </div>
    </div>
    </div>
</section>
<foooter>
    <div class="container-fluid">
        <div class="row pt-5 mt-5 m-3 border-bottom border-dark">
            <div class="col-md-12 d-flex justify-content-center text-black-50">
                Disclaimer: The prescription has been issued based on your inputs during chat/call with the doctor. In case of
                emergency please visit a nearby hospital.
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <h4 class="text-black-50">Powered by<span><img src="img/logo.png" height="50px" width="90px"></span></h4>
                 
            </div>
        </div>
    </div>
</foooter>
</body>
</html>