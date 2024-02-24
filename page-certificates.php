<?php
/**
 * Template Name: Certificates
 * @package agromedika
 */

get_header();
?>

<main>
        <section id="no-jumbotron" class="bg-lteal">
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-auto text-center">
                  <h1 class="fw-bold text-black">Certificates</h1>
                  <h5 class="text-black mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus sint ea facilis vel et aut earum deserunt? Harum, tempore sequi.</h5>
                </div>
              </div>
            </div>
          </section>
    

        <section id="main" class="bg-lteal">
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                  <h5 class="fw-bold mb-4"><i class="bi bi-filter me-2"></i>Filter Options</h5>
                  <ul id="filter-menu" class="list-unstyled list-group list-group-flush">
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="all">All</button>
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="fda">FDA</button>
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="gmp">GMP</button>
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="occp">OCCP</button>
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="halal">HALAL</button>
                    <button type="button" class="filter-item list-group-item list-group-item-action text-secondary" data-filter="haccp">HACCP</button>
                  </ul>
                </div>
                <div class="col-12 col-md-8 col-lg-9 mt-5 mt-lg-0">
                  <div class="container-img">
                    <div class="card border-0 bg-transparent rounded-4">
                        <div class="card-image position-relative rounded-4">
                          <a href="assets/imgs/close-up-medicine-pills-table.jpg" class="text-decoration-none text-black" data-fancybox="gallery" data-id="fda" data-caption="Lorem ipsum dolor sit amet-1">
                            <img src="assets/imgs/close-up-medicine-pills-table.jpg" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="assets/imgs/research.jpg" data-fancybox="gallery" data-id="fda" data-caption="Lorem ipsum dolor sit amet-2">
                              <img src="assets/imgs/research.jpg" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?travel" data-fancybox="gallery" data-id="haccp" data-caption="Lorem ipsum dolor sit amet-3">
                              <img src="https://source.unsplash.com/1280x720/?travel" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?building" data-fancybox="gallery" data-id="halal" data-caption="Lorem ipsum dolor sit amet-4">
                              <img src="https://source.unsplash.com/1280x720/?building" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?flower" data-fancybox="gallery" data-id="gmp" data-caption="Lorem ipsum dolor sit amet-5">
                              <img src="https://source.unsplash.com/1280x720/?flower" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?animal" data-fancybox="gallery" data-id="gmp" data-caption="Lorem ipsum dolor sit amet-6">
                              <img src="https://source.unsplash.com/1280x720/?animal" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?sport" data-fancybox="gallery" data-id="gmp" data-caption="Lorem ipsum dolor sit amet-7">
                              <img src="https://source.unsplash.com/1280x720/?sport" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?human" data-fancybox="gallery" data-id="occp" data-caption="Lorem ipsum dolor sit amet-8">
                              <img src="https://source.unsplash.com/1280x720/?human" alt="Image Gallery" class="rounded-4">
                          </a>
                        </div>
                    </div>
                    <div class="card border-0 bg-transparent">
                        <div class="card-image position-relative rounded-4">
                          <a href="https://source.unsplash.com/1280x720/?mountain" data-fancybox="gallery" data-id="occp" data-caption="Lorem ipsum dolor sit amet-9">
                              <img src="https://source.unsplash.com/1280x720/?mountain" alt="Image Gallery" class="rounded-4">
                              
                          </a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>

    </main>


<?php get_footer(); ?>