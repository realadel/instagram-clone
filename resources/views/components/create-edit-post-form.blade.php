<input type="file" class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl" name="image" id="file_input">
<p class="mt-2 text-sm text-gray-500" id="file_input_help">PNG, JPG or GIF</p>
<textarea name="description" rows="5" class="mt-10 w-full border bg-gray-50 rounded-xl" placeholder="{{ __('Write a description ...') }}">{{ $post->description ?? old('description') }}</textarea>
