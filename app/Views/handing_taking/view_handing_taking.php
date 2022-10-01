<div class="container">
    <h3 class="mt-3">Site Handing/Taking Data</h3>
    <table class="table table-striped table-bordered" style="width:100%">
        <tbody>
            <tr>
                <td class="font-weight-bold">Handing/Taking Over Date</td>
                <td><?= $handing_taking[0]['handing_over_date']; ?></td>
                <td class="font-weight-bold">Handed Over By (Contractor)</td>
                <td><?= $handing_taking[0]['handed_over_by']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Taken Over by (Beneficiary)</td>
                <td><?= $handing_taking[0]['take_over_by']; ?></td>
                <td class="font-weight-bold">Beneficiary CNIC</td>
                <td><?= $handing_taking[0]['beneficiary_cnic']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Beneficiary Pic with PV Modules</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#beneficiary_pic_pv_module">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="beneficiary_pic_pv_module" tabindex="-1" role="dialog"
                        aria-labelledby="beneficiary_pic_pv_moduleLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="beneficiary_pic_pv_moduleLabel">Beneficiary Pic with PV Modules</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$handing_taking[0]['beneficiary_pic_pv_module']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Beneficiary Pic with Inverter</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#beneficiary_pic_inverter">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="beneficiary_pic_inverter" tabindex="-1" role="dialog"
                        aria-labelledby="beneficiary_pic_inverterLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="beneficiary_pic_inverterLabel">Beneficiary Pic with Inverter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$handing_taking[0]['beneficiary_pic_inverter']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Beneficiary Pic with Fan/Lights</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#beneficiary_pic_fan_lights">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="beneficiary_pic_fan_lights" tabindex="-1" role="dialog"
                        aria-labelledby="beneficiary_pic_fan_lightsLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="beneficiary_pic_fan_lightsLabel">Beneficiary Pic with Fan/Lights</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$handing_taking[0]['beneficiary_pic_fan_lights']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Handing/Taking Over Certificate Pic</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#handing_over_certificate">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="handing_over_certificate" tabindex="-1" role="dialog"
                        aria-labelledby="handing_over_certificateLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="handing_over_certificateLabel">Handing/Taking Over Certificate Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$handing_taking[0]['handing_over_certificate']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>