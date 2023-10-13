<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import axios from 'axios';
import { onMounted, ref, inject, computed } from 'vue';
import Icon from '@/Components/Icon.vue';
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const pagePermission = computed(() => page.props.user.permissions)

console.log(pagePermission.value)

const swal = inject('$swal')
const apiusers = ref([])


function showAlert() {
    swal({
        icon: 'success',
        title: 'Category saved successfully'
    })
}

onMounted(() => {
        //console.log('montado com sucesso')
        axios.get('/api/users').then(response =>(
            //console.log(response.data)
            apiusers.value = response.data
           //console.log(apiusers.value)
        ))
    })
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <!-- <ApplicationLogo class="block h-12 w-auto" /> -->
            <Icon name="fox-logo"  class="w-10 h-10 bg-white hover:fill-cyan-700" />
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Bem vindo a pagina de usuários!
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                ecosystem to be a breath of fresh air. We hope you love it.
            </p>
            <div class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed flex">
                <div class="w-1/4">
                    <h1>Retono da Api</h1>
                    {{ apiusers }}
                </div>
                <div class="w-1/4" >
                    <h1>Resultado do props</h1>
                    <pre>
                        {{ $page.props }}
                    </pre>
                </div>
                <div class="2/4" >
                    <div v-if="$page.props.user.permissions.includes('read articles')">
                        <button type="button" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded align-middle"
                        >Read article</button>
                    </div>

                    <div v-if="$page.props.user.permissions.includes('write articles')">
                        <button type="button" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded align-middle"
                        >Write article</button>
                    </div>

                    <div 
                    class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded align-middle"
                    v-if="$page.props.user.permissions.includes('edit articles')">
                        <button type="button">Edit article</button>

                    </div>

                    <div 
                    class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded align-middle"
                    v-if="$page.props.user.permissions.includes('delete articles')">
                        <button type="button">Delete article</button>
                    </div>
                    <div 
                    class="ml-4 bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded align-middle"
                    >
                        <button type="button" @click="showAlert">SweetAlert2</button>
                    </div>
                </div>
                <div>
                    {{ pagePermission.includes('read articles')  }}
                </div>
            </div>
        </div>

        
    </div>
</template>
