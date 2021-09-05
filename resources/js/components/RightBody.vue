<template>
  <div id="right">
    <h1>Development CRM</h1>

    <div class="horizontal">
      <img :src="'/images/horizontal.png'" alt="horizontal"/>

    </div>

    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem sapiente quaerat nulla nesciunt obcaecati adipisci. Tempora, sit reiciendis? Eum natus alias beatae quaerat minima saepe, minus unde! Temporibus, in eum?
    </p>

    <div class="task">
      <div class="add-tasks">
        <h2>Today Task's</h2>

        <div class="add-action">
          <img :src="'/images/add.png'" alt="">
        </div>
      </div>

      <ul class="tasks-list">
      </ul>
    </div>

    <div class="upcoming">
      <div class="add-tasks">
        <h2>Upcoming</h2>
        <div class="add-action">
          <img :src="'/images/add.png'" alt="">
        </div>
      </div>

        <form action="" @submit="addUpcomingTask">
          <input type="text" v-model="newTask">
        </form>

        <ul class="tasks-list">
          <li v-for="upcomingTask in upcoming" v-bind:key="upcomingTask.id">
            <div class="info">

              <div class="left">
                <label class="myCheckBox">
                  <input 
                    type="checkbox" 
                    name="test" 
                    :checked="upcomingTask.completed" 
                    @change="checkUpcoming(upcomingTask.taskID)"
                  />
                  <span></span>
                </label>
                <h4>{{upcomingTask.title}}</h4>
              </div>

              <div class="right">
                <img :src="'/images/edit.png'" alt="">
                <img :src="'/images/del.png'" alt="" @click="delUpcoming(upcomingTask.taskID)">
              </div>

            </div>
          </li>
        </ul>

      <!-- </div> -->
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      todayTasks: [],
      upcoming: [],
      newTask: ""
    };
  },
  created() {
    this.fetchTodayTasks();
    this.fetchUpcoming();
  },
  methods: {
    fetchUpcoming(){
      fetch('http://laravel-customer-retail-management.test/api/upcoming')
        .then(res => res.json())
        .then(({data}) => {
          this.upcoming = data;
          console.log(data);
        })
        .catch((err) => console.log(err));
    },
    addUpcomingTask(){},
    fetchTodayTasks(){}
  },
}
</script>

<style>

</style>