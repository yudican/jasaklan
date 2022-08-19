<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                Nama
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3">
                Link Referral
            </th>
            <th scope="col" class="px-6 py-3">
                Terdaftar Pada
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($referrals as $referral)
        <tr class="bg-white border-b hover:bg-gray-50">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $referral->user->name }}
            </th>
            <td class="px-6 py-4">
                {{ $referral->user->email }}
            </td>
            <td class="px-6 py-4">
                {{ $referral->user->getReferralUrl() }}
            </td>
            <td class="px-6 py-4">
                {{ $referral->created_at->format('F j, Y h:i a') }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
