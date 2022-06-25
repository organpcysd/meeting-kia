<!-- Modal -->
<div class="modal fade" id="showdata" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>ข้อมูลลูกค้า</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>ชื่อ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="cus_name"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>ชื่อเล่น</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="nickname"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>อีเมล</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="email"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>เบอร์โทร</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="phone"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>LineID</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="lineid"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <h6>ข้อมูลที่ปรึกษา</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>ชื่อ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="user_name"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>เบอร์โทร</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="user_phone"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <hr />
                                <h6>รายละเอียดการชำระเงิน</h6>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>รถยนต์</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="car"></p>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>เงื่อนไข</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p id="condition"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>ราคารถยนต์</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="car_price"></p>
                                    </div>

                                    <div class="col-sm-7">
                                        <label>ส่วนลด ราคารถยนต์</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <p id="payment_discount"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>ค่าจดทะเบียน</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="payment_regis"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>มัดจำป้ายแดง</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="deposit_roll"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>ค่าอุปกรณ์แต่งรถยนต์</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="payment_decorate"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>ค่าเบี้ยประกัน</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="payment_insurance"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>ค่าใช้จ่ายอื่นๆ</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="payment_other"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>หักรถยนต์คันเก่า</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="payment_car_turn"></p>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>ค่าใช้จ่ายวันออกรถ</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p id="subtotal"></p>
                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-6" id="car_credit">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>ราคารถยนต์ สุทธิ</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="price_car_net"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>เงินดาวน์</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="payment_down"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>ส่วนลด เงินดาวน์</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="payment_down_discount"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>ระยะเวลาผ่อนชำระ</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="term_credit"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>อัตราดอกเบี้ยต่อปี</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="interest"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>ยอดจัดเช่าซื้อ</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="hire_purchase"></p>
                                    </div>

                                    <div class="col-sm-8">
                                        <label>ค่างวดต่อเดือน (รวม VAT)</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <p id="term_payment"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>อุปกรณ์แต่งที่แถม</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="accessories"></p>
                                    </div>
                                    <div class="col-sm-12"><hr/></div>
                                    <div class="col-sm-3">
                                        <label>วันที่จอง</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="reserved_date"></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>ค่ามัดจำ</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="payable"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
