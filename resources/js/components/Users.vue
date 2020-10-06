<template>
  <div class="container m-auto">
    <div
      v-for="user in users"
      :key="user.id"
      class="bg-grey-100 shadow mb-4 py-4"
    >
      <span
        class="rounded ml-2"
        :class="{ 'bg-green-600': user.online, 'bg-red-600': !user.online }"
      >
        {{ userStatus(user) }}
      </span>
      -
      <span>{{ user.name }}</span>
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      users: [],
    };
  },
  methods: {
    userStatus(user) {
      if (user.online) {
        return "Online";
      }
      return "Offline";
    },
    changeStatus(online_user, status) {
      const index = this.users.findIndex((user) => user.id === online_user.id);

      this.users[index].online = status;
    },
  },
  mounted() {
    this.users = this.usersArray;
    this.users.forEach((user, index) => {
      this.$set(this.users[index], "online", false);
    });

    Echo.join("status")
      .here((users) => {
        users.forEach((user) => {
          this.changeStatus(user, true);
        });
      })
      .joining((user) => {
        this.changeStatus(user, true);
      })
      .leaving((user) => {
        this.changeStatus(user, false);
      });
  },
  props: {
    usersArray: Array,
  },
};
</script>
