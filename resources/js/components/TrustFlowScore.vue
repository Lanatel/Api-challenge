<template>
  <b-container class="m-wrapper">
    <b-row class="m-title">Trust Flow</b-row>
    <b-row v-if="!!error" v-text="error" class="text-center"></b-row>
    <template v-else>
      <b-row v-for="(item, key) in items" :key="key" class="m-row">
        <b-col cols="6" class="border-right text-right">
          <a :href="item.name" v-text="formatName(item.name)" class="m-link" target="_blank"></a>
        </b-col>
        <b-col cols="6" v-text="item.trustFlowScore" class="m-score" :class="{'m-score-updated' : isUpdated}"></b-col>
      </b-row>
    </template>
    <button class="m-button" @click="refreshData" :disabled="isLoading">
      <b-icon-arrow-counterclockwise :class="{'m-button--loading' : isLoading}"></b-icon-arrow-counterclockwise>
    </button>
  </b-container>
</template>

<script>
import { BContainer, BCol, BRow, BIconArrowCounterclockwise } from 'bootstrap-vue'

export default {
  name: "TrustFlowScore",
  components: {
    BContainer,
    BCol,
    BRow,
    BIconArrowCounterclockwise
  },
  data() {
    return {
      items: [],
      error: '',
      isLoading: false,
      isUpdated: false
    }
  },
  mounted() {
    this.getItems()
  },
  methods: {
    async getItems() {
      try {
        const response = await axios.get('/website-scores');
        this.items = response.data;
      } catch (error) {
        this.error = 'Sorry, data is not available right now. Try to update it by pushing the button below.'
      }
    },
    async refreshData() {
      this.isLoading = true;
      this.error = '';
      try {
        await axios.put('/website-scores');
        await this.getItems();
        this.isUpdated = true;
      } catch (error) {
        this.items = [];
        this.error = 'Failed to update data. Please try again';
      }
      setTimeout(() => {
        this.isLoading = false;
        this.isUpdated = false;
      }, 300);
    },
    formatName(name) {
      return name.match(/^https:\/\/(.+)\./)[1]
    }
  }
}
</script>

<style scoped>
  .m-title {
    font-family: 'Lato', sans-serif;
    font-size: 120px;
  }
  .m-wrapper {
    display: flex;
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    margin-top: 20vh;
  }
  .m-row {
    width: 100%;
  }
  .m-link {
    text-decoration: none;
    color: magenta;
    transition: all 0.3s ease-out;
    outline: none;
  }
  .m-link:hover {
    color: cyan;
  }
  .m-button {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: 1px solid #dee2e6;
    font-size: 24px;
    color: magenta;
    background-color: rgba(255, 0, 255, 0.05);
    transition: all 0.3s ease-out;
    outline: none;
  }
  .m-button:hover {
    color: cyan;
    background-color: rgba(0, 255, 255, 0.05);
  }
  .m-button--loading {
    animation: button-loading-spinner 0.6s ease infinite;
  }
  .m-score {
    transition: all 0.3s ease-in-out;
  }
  .m-score-updated {
    color: cyan;
  }
  @keyframes button-loading-spinner {
    from {
      transform: rotate(0turn);
    }

    to {
      transform: rotate(-1turn);
    }
  }
  @media (max-width: 400px) {
    .m-title {
      font-size: 60px;
    }
  }
  @media (max-width: 800px) {
    .m-title {
      font-size: 72px;
    }
  }
</style>
