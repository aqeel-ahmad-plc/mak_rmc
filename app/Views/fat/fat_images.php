<div class="container">
    <h3 class="mt-3">Site FAT</h3>
    <h4 class="mt-3">Site FAT Images</h4>
    <div>
        <?php if (isset($validation)): ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reason_of_rejection_pic_1">Reason of Rejection (Pic-1)</label>
                        <div>
                            <?php if ($fat[0]['reason_of_rejection_pic_1']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['reason_of_rejection_pic_1']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['reason_of_rejection_pic_1']==""): ?>
                                <label for="reason_of_rejection_pic_1">Select a file:</label>
                                <input type="file" id="reason_of_rejection_pic_1" name="reason_of_rejection_pic_1">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['reason_of_rejection_pic_1']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['reason_of_rejection_pic_1']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reason_of_rejection_pic_2">Reason of Rejection (Pic-2)</label>
                        <div>
                            <?php if ($fat[0]['reason_of_rejection_pic_2']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['reason_of_rejection_pic_2']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['reason_of_rejection_pic_2']==""): ?>
                                <label for="reason_of_rejection_pic_2">Select a file:</label>
                                <input type="file" id="reason_of_rejection_pic_2" name="reason_of_rejection_pic_2">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['reason_of_rejection_pic_2']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['reason_of_rejection_pic_2']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fat_report_pic">FAT Report (Pic)</label>
                        <div>
                            <?php if ($fat[0]['fat_report_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['fat_report_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['fat_report_pic']==""): ?>
                                <label for="fat_report_pic">Select a file:</label>
                                <input type="file" id="fat_report_pic" name="fat_report_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['fat_report_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['fat_report_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pv_module_pic">PV Modules Pic</label>
                        <div>
                            <?php if ($fat[0]['pv_module_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['pv_module_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['pv_module_pic']==""): ?>
                                <label for="pv_module_pic">Select a file:</label>
                                <input type="file" id="pv_module_pic" name="pv_module_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['pv_module_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['pv_module_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="storage_inverter_module_pic">Storage & Inverter Module Pic</label>
                        <div>
                            <?php if ($fat[0]['storage_inverter_module_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['storage_inverter_module_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['storage_inverter_module_pic']==""): ?>
                                <label for="storage_inverter_module_pic">Select a file:</label>
                                <input type="file" id="storage_inverter_module_pic" name="storage_inverter_module_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['storage_inverter_module_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['storage_inverter_module_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="earthing_pic">Earthing Pic</label>
                        <div>
                            <?php if ($fat[0]['earthing_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['earthing_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['earthing_pic']==""): ?>
                                <label for="earthing_pic">Select a file:</label>
                                <input type="file" id="earthing_pic" name="earthing_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['earthing_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['earthing_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lights_pic">Lights Pic</label>
                        <div>
                            <?php if ($fat[0]['lights_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['lights_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['lights_pic']==""): ?>
                                <label for="lights_pic">Select a file:</label>
                                <input type="file" id="lights_pic" name="lights_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['lights_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['lights_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fans_pic">Fans Pic</label>
                        <div>
                            <?php if ($fat[0]['fans_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['fans_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['fans_pic']==""): ?>
                                <label for="fans_pic">Select a file:</label>
                                <input type="file" id="fans_pic" name="fans_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['fans_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['fans_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="distribution_board_pic">Distribution Boards Pic</label>
                        <div>
                            <?php if ($fat[0]['distribution_board_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['distribution_board_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['distribution_board_pic']==""): ?>
                                <label for="distribution_board_pic">Select a file:</label>
                                <input type="file" id="distribution_board_pic" name="distribution_board_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['distribution_board_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['distribution_board_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dc_wiring_pic">DC Wiring Pic</label>
                        <div>
                            <?php if ($fat[0]['dc_wiring_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['dc_wiring_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['dc_wiring_pic']==""): ?>
                                <label for="dc_wiring_pic">Select a file:</label>
                                <input type="file" id="dc_wiring_pic" name="dc_wiring_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['dc_wiring_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['dc_wiring_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ac_wiring_pic">AC Wiring Pic</label>
                        <div>
                            <?php if ($fat[0]['ac_wiring_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['ac_wiring_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['ac_wiring_pic']==""): ?>
                                <label for="ac_wiring_pic">Select a file:</label>
                                <input type="file" id="ac_wiring_pic" name="ac_wiring_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['ac_wiring_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['ac_wiring_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="testing_pic_1">Testing Pic  - 1</label>
                        <div>
                            <?php if ($fat[0]['testing_pic_1']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_1']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['testing_pic_1']==""): ?>
                                <label for="testing_pic_1">Select a file:</label>
                                <input type="file" id="testing_pic_1" name="testing_pic_1">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['testing_pic_1']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['testing_pic_1']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="testing_pic_2">Testing Pic  - 2</label>
                        <div>
                            <?php if ($fat[0]['testing_pic_2']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_2']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['testing_pic_2']==""): ?>
                                <label for="testing_pic_2">Select a file:</label>
                                <input type="file" id="testing_pic_2" name="testing_pic_2">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['testing_pic_2']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['testing_pic_2']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="testing_pic_3">Testing Pic  - 3</label>
                        <div>
                            <?php if ($fat[0]['testing_pic_3']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_3']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['testing_pic_3']==""): ?>
                                <label for="testing_pic_3">Select a file:</label>
                                <input type="file" id="testing_pic_3" name="testing_pic_3">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['testing_pic_3']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['testing_pic_3']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rep_group_pic">Rep. Group Pic</label>
                        <div>
                            <?php if ($fat[0]['rep_group_pic']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['rep_group_pic']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($fat[0]['rep_group_pic']==""): ?>
                                <label for="rep_group_pic">Select a file:</label>
                                <input type="file" id="rep_group_pic" name="rep_group_pic">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($fat[0]['rep_group_pic']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($fat[0]['rep_group_pic']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <hr>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/fat/fat_images/".$fat[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="fat_complete" id="fat_complete" value="1">
                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Complete Site FAT</button>
            </form>
        </div>
    </div>
</div>