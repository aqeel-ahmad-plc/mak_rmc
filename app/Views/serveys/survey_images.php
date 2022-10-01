<div class="container">
    <h3 class="mt-3">Site Survey</h3>
    <h4 class="mt-3">Site Survey Images</h4>
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
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="khatib_caretaker_pic_path">Khatib/ Caretaker Pic</label>
                        <div>
                            <?php if ($servey[0]['khatib_caretaker_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['khatib_caretaker_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['khatib_caretaker_pic_path']==""): ?>
                                <label for="khatib_caretaker_pic_path">Select a file:</label>
                                <input type="file" id="khatib_caretaker_pic_path" name="khatib_caretaker_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['khatib_caretaker_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['khatib_caretaker_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="site_sketch_pic_path">Site Sketch Pic</label>
                        <div>
                            <?php if ($servey[0]['site_sketch_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['site_sketch_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['site_sketch_pic_path']==""): ?>
                                <label for="site_sketch_pic_path">Select a file:</label>
                                <input type="file" id="site_sketch_pic_path" name="site_sketch_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['site_sketch_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['site_sketch_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="roof_top_pic_01_path">Roof top Pic - 01</label>
                        <div>
                            <?php if ($servey[0]['roof_top_pic_01_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['roof_top_pic_01_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['roof_top_pic_01_path']==""): ?>
                                <label for="roof_top_pic_01_path">Select a file:</label>
                                <input type="file" id="roof_top_pic_01_path" name="roof_top_pic_01_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['roof_top_pic_01_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['roof_top_pic_01_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="roof_top_pic_02_path">Roof top Pic - 02</label>
                        <div>
                            <?php if ($servey[0]['roof_top_pic_02_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['roof_top_pic_02_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['roof_top_pic_02_path']==""): ?>
                                <label for="roof_top_pic_02_path">Select a file:</label>
                                <input type="file" id="roof_top_pic_02_path" name="roof_top_pic_02_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['roof_top_pic_02_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['roof_top_pic_02_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mdb_pic_path">MDB Pic</label>
                        <div>
                            <?php if ($servey[0]['mdb_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['mdb_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['mdb_pic_path']==""): ?>
                                <label for="mdb_pic_path">Select a file:</label>
                                <input type="file" id="mdb_pic_path" name="mdb_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['mdb_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['mdb_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inverter_placement_pic_path">Inverter Placement Pic</label>
                        <div>
                            <?php if ($servey[0]['inverter_placement_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['inverter_placement_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['inverter_placement_pic_path']==""): ?>
                                <label for="inverter_placement_pic_path">Select a file:</label>
                                <input type="file" id="inverter_placement_pic_path" name="inverter_placement_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['inverter_placement_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['inverter_placement_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="earth_point_pic_path">Earth Point Pic</label>
                        <div>
                            <?php if ($servey[0]['earth_point_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['earth_point_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['earth_point_pic_path']==""): ?>
                                <label for="earth_point_pic_path">Select a file:</label>
                                <input type="file" id="earth_point_pic_path" name="earth_point_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['earth_point_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['earth_point_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="motor_pic_path">Motor Pic</label>
                        <div>
                            <?php if ($servey[0]['motor_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['motor_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['motor_pic_path']==""): ?>
                                <label for="motor_pic_path">Select a file:</label>
                                <input type="file" id="motor_pic_path" name="motor_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['motor_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['motor_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="internal_wiring_pic_path">Internal Wiring Pic</label>
                        <div>
                            <?php if ($servey[0]['internal_wiring_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['internal_wiring_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['internal_wiring_pic_path']==""): ?>
                                <label for="internal_wiring_pic_path">Select a file:</label>
                                <input type="file" id="internal_wiring_pic_path" name="internal_wiring_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['internal_wiring_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['internal_wiring_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_01_path">Optional Pic-01</label>
                        <div>
                            <?php if ($servey[0]['optional_pic_01_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_01_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['optional_pic_01_path']==""): ?>
                                <label for="optional_pic_01_path">Select a file:</label>
                                <input type="file" id="optional_pic_01_path" name="optional_pic_01_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['optional_pic_01_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['optional_pic_01_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_02_path">Optional Pic-02</label>
                        <div>
                            <?php if ($servey[0]['optional_pic_02_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_02_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['optional_pic_02_path']==""): ?>
                                <label for="optional_pic_02_path">Select a file:</label>
                                <input type="file" id="optional_pic_02_path" name="optional_pic_02_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['optional_pic_02_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['optional_pic_02_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_03_path">Optional Pic-03</label>
                        <div>
                            <?php if ($servey[0]['optional_pic_03_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_03_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['optional_pic_03_path']==""): ?>
                                <label for="optional_pic_03_path">Select a file:</label>
                                <input type="file" id="optional_pic_03_path" name="optional_pic_03_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['optional_pic_03_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['optional_pic_03_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_04_path">Optional Pic-04</label>
                        <div>
                            <?php if ($servey[0]['optional_pic_04_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_04_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['optional_pic_04_path']==""): ?>
                                <label for="optional_pic_04_path">Select a file:</label>
                                <input type="file" id="optional_pic_04_path" name="optional_pic_04_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['optional_pic_04_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['optional_pic_04_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="optional_pic_05_path">Optional Pic-05</label>
                        <div>
                            <?php if ($servey[0]['optional_pic_05_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_05_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['optional_pic_05_path']==""): ?>
                                <label for="optional_pic_05_path">Select a file:</label>
                                <input type="file" id="optional_pic_05_path" name="optional_pic_05_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['optional_pic_05_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['optional_pic_05_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rep_group_pic_path">Rep. Group Pic</label>
                        <div>
                            <?php if ($servey[0]['rep_group_pic_path']!=""): ?>
                                <img width="100" height="100"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['rep_group_pic_path']; ?>" alt=""
                                        srcset="">
                            <?php elseif ($servey[0]['rep_group_pic_path']==""): ?>
                                <label for="rep_group_pic_path">Select a file:</label>
                                <input type="file" id="rep_group_pic_path" name="rep_group_pic_path">
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $servey[0]['site_id'];?>">
                        </div>
                    </div>
                </div>
                <?php if ($servey[0]['rep_group_pic_path']!=""): ?>
                    <span class="badge badge-success text-center pt-2" style="width:10vw;height:2vw;"><i class="fas fa-check-circle"></i> Image Uploaded</span>
                <?php elseif ($servey[0]['rep_group_pic_path']==""): ?>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <hr>
    <div class="row py-2">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <form action="<?php echo base_url()."/serveys/survey_images/".$servey[0]['site_id'];?>" method="post"
                enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="survey_complete" id="survey_complete" value="1">
                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Complete Survey</button>
            </form>
        </div>
    </div>
</div>