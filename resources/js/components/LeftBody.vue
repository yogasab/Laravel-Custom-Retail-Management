<template>
  <div id="left">
    <img :src="'/images/hamburger.png'" alt="">

    <div class="profile">
      <h1>Hello, Yoga</h1>
      <h2>Let's make your project more amazing</h2>
    </div>

    <div class="search">
      <input type="text" placeholder="Search a project ...">
      <img :src="'/images/search.png'" alt="">
    </div>

    <div class="project">
      <h3>Projects <span>(18)</span></h3>

      <div class="projects">
        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Development</h6>
        </div>

        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Design</h6>
        </div>

        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Testing</h6>
        </div>

        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Medium Draft</h6>
        </div>

        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Landing Page</h6>
        </div>

        <div class="a-project">
          <div class="box-color">
            <img :src="'/images/overlay.png'" alt="">
            <span>PT</span>
          </div>
          
          <h6>Add Project</h6>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>