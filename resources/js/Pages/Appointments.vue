<template>
    <div>
        <h1>Appointments</h1>
        <form @submit.prevent="createAppointment">
            <input v-model="name" placeholder="Name" required />
            <input v-model="barberId" placeholder="Barber ID" required />
            <input v-model="appointment" type="datetime-local" required />
            <button type="submit">Add Appointment</button>
        </form>
        <ul>
            <li v-for="appointment in appointments" :key="appointment.id">
                {{ appointment.name }} - {{ appointment.appointment }}
                <button @click="deleteAppointment(appointment.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const appointments = ref([]);
        const name = ref('');
        const barberId = ref('');
        const appointment = ref('');

        const fetchAppointments = async () => {
            const response = await axios.get('/api/appointments');
            appointments.value = response.data;
        };

        const createAppointment = async () => {
            await axios.post('/api/appointments', {
                name: name.value,
                barber_id: barberId.value,
                appointment: appointment.value,
            });
            name.value = '';
            barberId.value = '';
            appointment.value = '';
            fetchAppointments();
        };

        const deleteAppointment = async (id) => {
            await axios.delete(`/api/appointments/${id}`);
            fetchAppointments();
        };

        onMounted(fetchAppointments);

        return {
            appointments,
            name,
            barberId,
            appointment,
            createAppointment,
            deleteAppointment,
        };
    },
};
</script>
