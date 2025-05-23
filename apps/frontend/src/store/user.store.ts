import { defineStore } from 'pinia';
import userApi from '@/api/user.api';
import { User } from '@/lib/interfaces/user.interface';

interface UserStore {
  current: User | null;
  index: User[];
}

export const useUserStore = defineStore('user', {
  state: (): UserStore => {
    return {
      current: null,
      index: [],
    };
  },
  actions: {
    async getAll() {
      this.index = await userApi.index();
    },
  },
});
