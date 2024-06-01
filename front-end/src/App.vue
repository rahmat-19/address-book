<template>
  <div>
    <nav>
      <div class="title-navbar">Countac Mange</div>
      <div class="item-navbar">
        <router-link :to="{ name: 'home' }" class="item">Dahboard</router-link>
        <router-link :to="{ name: 'users.index' }" class="item"
          >Users</router-link
        >
      </div>
    </nav>

    <div class="notification error">
      <span class="title">Error</span>
      <span class="message">Berhasil Menambahkan Data</span>
    </div>

    <!--- render router view -->
    <router-view class="body-component"></router-view>
  </div>
</template>
