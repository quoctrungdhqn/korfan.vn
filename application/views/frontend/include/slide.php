<?php
$CI =& get_instance();
$this->load->model('Slide_model');
$slides = $this->Slide_model->getSliders();
?>

<div class="section_offset">

    <div class="row">

        <!-- - - - - - - - - - - - - - Main slider - - - - - - - - - - - - - - - - -->

        <div class="col-sm-12">

            <!-- - - - - - - - - - - - - - Revolution slider - - - - - - - - - - - - - - - - -->

            <div class="revolution_slider">

                <div class="rev_slider">

                    <ul>

                        <?php
                        foreach ($slides as $item) {
                            ?>
                            <li data-transition="papercut" data-slotamount="7">

                                <img src="<?php echo base_url() ?>uploads/slide/<?php echo $item->image; ?>" alt="">

                            </li>
                            <?php
                        }
                        ?>

                    </ul>

                </div><!--/ .rev_slider-->

            </div><!--/ .revolution_slider-->

            <!-- - - - - - - - - - - - - - End of Revolution slider - - - - - - - - - - - - - - - - -->

        </div><!--/ [col]-->

        <!-- - - - - - - - - - - - - - End of main slider - - - - - - - - - - - - - - - - -->

    </div><!--/ .row-->

</div><!--/ .section_offset -->