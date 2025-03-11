<template>
    <div class="relative">
      <!-- Mobile overlay -->
      <div 
        v-if="isOpen" 
        class="fixed inset-0 bg-black/50 z-20 lg:hidden"
        @click="toggleSidebar"
      ></div>
  
      <!-- Sidebar -->
      <aside 
        class="fixed top-0 left-0 z-30 h-screen transition-all duration-300 ease-in-out bg-theme-400 text-white shadow-lg"
        :class="[isOpen ? 'w-64' : 'w-16', 'lg:w-64 lg:translate-x-0', !isOpen && '-translate-x-full lg:translate-x-0 lg:w-16']"
      >
        <!-- Toggle button (visible on mobile) -->
        <!-- <button 
          @click="toggleSidebar" 
          class="absolute -right-10 top-4 bg-theme-400 text-white p-2 rounded-r-md lg:hidden"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button> -->
  
        <!-- Logo -->
        <div class="border-b border-white">
            <div class="flex justify-center items-center h-20 my-6">
            <router-link  :to="{ name: 'dashboard' }">
                <img 
                  :src="isOpen || window.innerWidth >= 1024 ? 'img/logo-viejo-bueno.png' : ''" 
                  alt="Logo" 
                  class="transition-all duration-300"
                />
            </router-link>
            </div>
        </div>
  
        <!-- Navigation -->
        <nav class="mt-5 px-2">
          <!-- Regular menu items -->
          <a 
            v-for="(item, index) in regularItems" 
            :key="`regular-${index}`"
            href="#" 
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-theme-300 rounded-md transition-colors group cursor-pointer"
          >
            <span class="inline-flex">
              <component :is="item.icon" class="h-5 w-5" />
            </span>
            <span 
              class="ml-3 transition-opacity duration-300"
              :class="[isOpen || window.innerWidth >= 1024 ? 'opacity-100' : 'opacity-0 hidden lg:inline-block lg:opacity-0']"
            >{{ item.name }}</span>
          </a>
  
          <!-- Collapsible sections -->
          <div v-for="(section, sectionIndex) in collapsibleSections" :key="`section-${sectionIndex}`" class="mt-2">
                <button 
                  @click="toggleSection(sectionIndex)"
                  class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-theme-300 rounded-md transition-colors cursor-pointer"
                >
                  <div class="flex items-center">
                    <i :class="section.icon"></i>
                    <span 
                      class="ml-3 transition-opacity duration-300"
                      :class="[isOpen || window.innerWidth >= 1024 ? 'opacity-100' : 'opacity-0 hidden lg:inline-block lg:opacity-0']"
                    >{{ section.name }}</span>
                  </div>
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    class="h-4 w-4 transition-transform duration-200"
                    :class="[section.isOpen ? 'rotate-180' : '', isOpen || window.innerWidth >= 1024 ? 'opacity-100' : 'opacity-0 hidden lg:inline-block lg:opacity-0']"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
  
            <!-- Submenu -->
            <div 
              v-if="section.isOpen && (isOpen || window.innerWidth >= 1024)" 
              class="mt-1 ml-4 pl-4 border-l border-white space-y-1 transition-all duration-300 ease-in-out"
            >
                <router-link  :to="{ name: 'slider' }">

                <a 
                    v-for="(subItem, subIndex) in section.items" 
                    :key="`sub-${sectionIndex}-${subIndex}`"
                    href="#" 
                    class="flex items-center px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-theme-300 rounded-md transition-colors cursor-pointer"
                >
                    {{ subItem.name }}
                </a>
                </router-link>
            </div>
          </div>
        </nav>
      </aside>
  
      <!-- Main content -->
      <!-- <div 
        class="transition-all duration-300 min-h-screen"
        :class="[isOpen ? 'lg:ml-64' : 'lg:ml-16']"
      >
        <button 
          @click="toggleSidebar" 
          class="fixed top-4 left-4 z-10 bg-gray-800 text-white p-2 rounded-md hidden lg:block"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8M4 18h16" />
          </svg>
        </button>
      </div> -->
    </div>
  </template>
  
<script>
import { ref, onMounted } from 'vue';
  
export default {
    data() {
      return {
        // State for sidebar open/closed
        isOpen: true,
        // State for window width
        window: {
          innerWidth: 0
        },
        // Regular menu items
        regularItems: [
        //   { name: 'Home', icon: 'HomeIcon', path: '/home' },
        //   { name: 'Analytics', icon: 'ChartBarIcon', path: '/analytics' },
        //   { name: 'Projects', icon: 'FolderIcon', path: '/projects' },
        ],
        // Collapsible sections
        collapsibleSections: [
          { 
            name: 'Home', 
            icon: 'fa-solid fa-house', 
            isOpen: false,
            items: [
              { name: 'Slider', path: '/settings/profile' },
              { name: 'Nosotros', path: '/settings/security' },
            ]
          },
        //   { 
        //     name: 'Team', 
        //     icon: 'UsersIcon', 
        //     isOpen: false,
        //     items: [
        //       { name: 'Members', path: '/team/members' },
        //       { name: 'Invitations', path: '/team/invitations' },
        //       { name: 'Roles', path: '/team/roles' }
        //     ]
        //   },
        //   { 
        //     name: 'Reports', 
        //     icon: 'DocumentReportIcon', 
        //     isOpen: false,
        //     items: [
        //       { name: 'Monthly', path: '/reports/monthly' },
        //       { name: 'Quarterly', path: '/reports/quarterly' },
        //       { name: 'Annual', path: '/reports/annual' }
        //     ]
        //   }
        ]
      };
    },
    methods: {
      // Toggle sidebar
      toggleSidebar() {
        this.isOpen = !this.isOpen;
      },
      // Toggle section open/closed
      toggleSection(index) {
        this.collapsibleSections[index].isOpen = !this.collapsibleSections[index].isOpen;
      }
    },
    mounted() {
      // Update window width on resize
      this.window.innerWidth = window.innerWidth;
  
      // Set initial state based on screen size
      if (this.window.innerWidth < 1024) {
        this.isOpen = false;
      }
  
      window.addEventListener('resize', () => {
        this.window.innerWidth = window.innerWidth;
      });
    }
  };
</script>
 
  