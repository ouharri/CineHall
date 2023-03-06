<template>

  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">
          Product name
        </th>
        <th scope="col" class="px-6 py-3">
          Color
        </th>
        <th scope="col" class="px-6 py-3">
          Category
        </th>
        <th scope="col" class="px-6 py-3">
          Price
        </th>
      </tr>
      </thead>
      <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Apple MacBook Pro 17"
        </th>
        <td class="px-6 py-4">
          Silver
        </td>
        <td class="px-6 py-4">
          Laptop
        </td>
        <td class="px-6 py-4">
          $2999
        </td>
      </tr>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Microsoft Surface Pro
        </th>
        <td class="px-6 py-4">
          White
        </td>
        <td class="px-6 py-4">
          Laptop PC
        </td>
        <td class="px-6 py-4">
          $1999
        </td>
      </tr>
      <tr class="bg-white dark:bg-gray-800">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Magic Mouse 2
        </th>
        <td class="px-6 py-4">
          Black
        </td>
        <td class="px-6 py-4">
          Accessories
        </td>
        <td class="px-6 py-4">
          $99
        </td>
      </tr>
      </tbody>
    </table>
  </div>


  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3 rounded-l-lg">
          Product name
        </th>
        <th scope="col" class="px-6 py-3">
          Qty
        </th>
        <th scope="col" class="px-6 py-3 rounded-r-lg">
          Price
        </th>
      </tr>
      </thead>
      <tbody>
      <tr class="bg-white dark:bg-gray-800">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Apple MacBook Pro 17"
        </th>
        <td class="px-6 py-4">
          1
        </td>
        <td class="px-6 py-4">
          $2999
        </td>
      </tr>
      <tr class="bg-white dark:bg-gray-800">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Microsoft Surface Pro
        </th>
        <td class="px-6 py-4">
          1
        </td>
        <td class="px-6 py-4">
          $1999
        </td>
      </tr>
      <tr class="bg-white dark:bg-gray-800">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          Magic Mouse 2
        </th>
        <td class="px-6 py-4">
          1
        </td>
        <td class="px-6 py-4">
          $99
        </td>
      </tr>
      </tbody>
      <tfoot>
      <tr class="font-semibold text-gray-900 dark:text-white">
        <th scope="row" class="px-6 py-3 text-base">Total</th>
        <td class="px-6 py-3">3</td>
        <td class="px-6 py-3">21,000</td>
      </tr>
      </tfoot>
    </table>
  </div>


</template>

<script>
export default {
  beforeCreate() {
    if (!localStorage.getItem("auth:cinhall")) {
      this.$router.push("/");
    }
  },
}
</script>

<style>

</style>