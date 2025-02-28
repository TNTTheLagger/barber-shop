<template>
    <div>
        <h1>Barbers</h1>
        <form @submit.prevent="createBarber">
            <input v-model="barberName" placeholder="Barber Name" required />
            <button type="submit">Add Barber</button>
        </form>
        <ul>
            <li v-for="barber in barbers" :key="barber.id">
                {{ barber.barber_name }}
                <button @click="deleteBarber(barber.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const barbers = ref([]);
        const barberName = ref('');

        const fetchBarbers = async () => {
            const response = await axios.get('/api/barbers');
            barbers.value = response.data;
        };

        const createBarber = async () => {
            await axios.post('/api/barbers', { barber_name: barberName.value });
            barberName.value = '';
            fetchBarbers();
        };

        const deleteBarber = async (id) => {
            await axios.delete(`/api/barbers/${id}`);
            fetchBarbers();
        };

        onMounted(fetchBarbers);

        return {
            barbers,
            barberName,
            createBarber,
            deleteBarber,
        };
    },
};
</script>
