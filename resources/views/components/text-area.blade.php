<div>
    <div class="w-full px-3 mt-2">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ $label }}</label>
        <textarea name="{{ $name ?? "textarea" }}" id="message" rows="4"
            class="block p-2.5 w-full text-sm text-gray-600 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ $message ?? " your message" }}">{{ $slot }}</textarea>
    </div>
</div>
