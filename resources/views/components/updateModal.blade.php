<div class="modal fade" id="myModal8" tabindex="-1" role="dialog">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                    <th class="text-center">Article#</th>
                    <th class="text-center">Outfit Name</th>
                    <th class="text-center">Hours</th>
                    <th class="text-center"> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="text-center"> 123 </td>
                                <td class="text-center"> 
                                    <a target="_blank" href="#" > Fit Me </a>
                                </td>
                                <td class="text-center">10 hours</td>
                                <td class="text-center"> 
                                    <div class="btn-group btn-group-xs">
                                        <button onclick="sendProduction()" title="Send To Production" class="btn btn-success"><i class="fa fa-paper-plane"></i></a>
                                    </div>     
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"> 45 </td>
                                <td class="text-center"> 
                                    <a target="_blank" href="#" > Rooper </a>
                                </td>
                                <td class="text-center">14 hours</td>
                                <td class="text-center"> 
                                    <div class="btn-group btn-group-xs">
                                        <button onclick="sendProduction()" disabled title="Send To Production" class="btn btn-success"><i class="fa fa-paper-plane"></i></a>
                                    </div>     
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"> 789 </td>
                                <td class="text-center"> 
                                    <a target="_blank" href="#" > Shamp </a>
                                </td>
                                <td class="text-center">23 hours</td>
                                <td class="text-center"> 
                                    <div class="btn-group btn-group-xs">
                                        <button onclick="sendProduction()" title="Send To Production" class="btn btn-success"><i class="fa fa-paper-plane"></i></a>
                                    </div>     
                                </td>
                            </tr>
                            
                        
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>