<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order
                                    Amount</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $key=>$item)
                            @php
                                $status = '';
                                $payment_status = '';
                                if($item->payment_status == 'paid'){
                                    $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                                }else if($item->payment_status == 'pending'){
                                    $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pending</span>';
                                }else if($item->payment_status == 'failed'){
                                    $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Failed</span>';
                                }
                                if($item->status == 'new'){
                                    $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">New</span>';
                                }else if($item->status == 'processing'){
                                    $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span>';
                                } else if($item->status == 'shipped'){
                                    $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Shipped</span>';
                                } else if($item->status == 'delivered'){
                                    $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Delivered</span>';
                                } else if($item->status == 'cancelled'){
                                    $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelled</span>';
                                }
                            @endphp
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key="{{ $key }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $item->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {!! $status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {!! $payment_status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ Number::currency($item->grand_total, 'INR') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="/my-orders/{{ $item->id }}" wire:navigate
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View
                                            Details</a>
                                    </td>
                                </tr>
                            @empty
                            <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                <td colspan="6"
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    No Any Order</td>

                            </tr>
                            @endforelse
                            @if ($orders->hasPages())
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $orders->links() }}
                                    </td>
                                </tr>
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
