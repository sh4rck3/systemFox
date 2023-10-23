<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import axios from 'axios';
import { onMounted, ref, inject, computed, watch } from 'vue';
import Icon from '@/Components/Icon.vue';
import { usePage } from '@inertiajs/vue3'
import useUsers from '../composables/usersinformationhome'


const page = usePage()

const pagePermission = computed(() => page.props.user.permissions)

const swal = inject('$swal')
const apiusers = ref([])


function showAlert() {
    swal({
        icon: 'success',
        title: 'Category saved successfully'
    })
}

const search_id = ref('')
const search_title = ref('')
const search_global = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')
const {users, getUsers, deleteUser} = useUsers()

onMounted(() => {
    getUsers()
})

const updateOrdering = (column) => {
    orderColumn.value = column;
    orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
    getUsers(
        1,
        search_id.value,
        search_title.value,
        search_global.value,
        orderColumn.value,
        orderDirection.value
    );
}
watch(search_id, (current, previous) => {
    getUsers(
        1,
        current,
        search_title.value,
        search_global.value
    )
})
watch(search_title, (current, previous) => {
    getUsers(
        1,
        search_id.value,
        current,
        search_global.value
    )
})
watch(search_global, (current, previous) => {
    getUsers(
        1,
        search_id.value,
        search_title.value,
        current
    )
})
</script>

<template>
    <div>
        <div class="">
            <!-- <ApplicationLogo class="block h-12 w-auto" /> -->
            <div class="relative sm:flex sm:justify-center sm:items-center">
                
                <div>
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                        Bem vindo a pagina de usuários!
                    </h1>
                </div>
            </div>
            
           

           
            <div class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                <div class="card-body shadow-sm">
                    <div class="mb-4">
                        <input v-model="search_global" type="text" placeholder="Buscar..."
                               class="form-control w-25">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                           
                            <tr>
                                <th class="px-6 py-3 text-start">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('id')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'id' }">
                                            ID
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'id',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('title')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'title' }">
                                            Nome
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row"
                                         @click="updateOrdering('email')">
                                        <div class="font-medium text-uppercase"
                                             :class="{ 'font-bold text-blue-600': orderColumn === 'email' }">
                                            Email
                                        </div>
                                        <div class="select-none">
                                <span :class="{
                                  'text-blue-600': orderDirection === 'asc' && orderColumn === 'email',
                                  'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'email',
                                }">&uarr;</span>
                                            <span :class="{
                                  'text-blue-600': orderDirection === 'desc' && orderColumn === 'email',
                                  'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'email',
                                }">&darr;</span>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row">
                                        <div class="font-medium text-uppercase">
                                            Ramal
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row">
                                        <div class="font-medium text-uppercase">
                                            Setor
                                        </div>
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <div class="flex flex-row">
                                        <div class="font-medium text-uppercase">
                                            Cargo
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post in users.data" :key="post.id">
                                <td class="px-6 py-4 text-sm">
                                    {{ post.id }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ post.name }} 
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ post.email }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ post.extension }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ post.sector }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ post.jobtitle }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <Pagination :data="users" :limit="3"
                                @pagination-change-page="page => getUsers(page, search_id, search_title, search_global, orderColumn, orderDirection)"
                                class="mt-4"/>
                </div>
            </div>
        </div>

        
    </div>
</template>
