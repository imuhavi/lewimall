@extends('backend.master')
@section('mail-box') active open @endsection
@section('inbox') active @endsection
@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/mail') }}">Inbox</a></li>
        <li class="active">Mail</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="mailbox-content">
          <div class="panel-heading clearfix">
            <h4 class="panel-title">All Mail</h4>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th colspan="1" class="hidden-xs">
                  <span><input type="checkbox" class="check-mail-all">Select All</span>
                </th>

                <th class="text-right" colspan="5">
                  <span class="text-muted m-r-sm">20 of 346 </span>
                  <a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i
                      class="fa fa-refresh"></i></a>
                  <div class="btn-group m-r-sm mail-hidden-options">
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i
                        class="fa fa-trash"></i></a>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Report Spam"><i
                        class="fa fa-exclamation-circle"></i></a>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Mark as Important"><i
                        class="fa fa-star"></i></a>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Mark as Read"><i
                        class="fa fa-pencil"></i></a>
                  </div>
                  <div class="btn-group m-r-sm mail-hidden-options">
                    <div class="btn-group">
                      <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                          class="fa fa-folder"></i> <span class="caret"></span></a>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#">Social</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Updates</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Spam</a></li>
                        <li><a href="#">Trash</a></li>
                        <li class="divider"></li>
                        <li><a href="#">New</a></li>
                      </ul>
                    </div>
                    <div class="btn-group">
                      <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                          class="fa fa-tags"></i> <span class="caret"></span></a>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#">Work</a></li>
                        <li><a href="#">Family</a></li>
                        <li><a href="#">Social</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Primary</a></li>
                        <li><a href="#">Promotions</a></li>
                        <li><a href="#">Forums</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-default"><i class="fa fa-angle-left"></i></a>
                    <a class="btn btn-default"><i class="fa fa-angle-right"></i></a>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr class="unread">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star icon-state-warning"></i>
                </td>
                <td class="hidden-xs">
                  Google
                </td>
                <td>
                  Nullam quis risus eget urna mollis ornare vel eu leo
                </td>
                <td>
                </td>
                <td>
                  21 march
                </td>
              </tr>
              <tr class="unread">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star icon-state-warning"></i>
                </td>
                <td class="hidden-xs">
                  Themeforest
                </td>
                <td>
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit
                </td>
                <td>
                </td>
                <td>
                  20 march
                </td>
              </tr>
              <tr class="unread">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star icon-state-warning"></i>
                </td>
                <td class="hidden-xs">
                  Adobe
                </td>
                <td>
                  Nullam quis risus eget urna mollis ornare vel eu leo
                </td>
                <td>
                  <i class="fa fa-paperclip"></i>
                </td>
                <td>
                  18 march
                </td>
              </tr>
              <tr class="unread">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star icon-state-warning"></i>
                </td>
                <td class="hidden-xs">
                  Apple
                </td>
                <td>
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit
                </td>
                <td>
                  <i class="fa fa-paperclip"></i>
                </td>
                <td>
                  14 march
                </td>
              </tr>
              <tr class="read">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star"></i>
                </td>
                <td class="hidden-xs">
                  Microsoft
                </td>
                <td>
                  Nullam quis risus eget urna mollis ornare vel eu leo
                </td>
                <td>
                  <i class="fa fa-paperclip"></i>
                </td>
                <td>
                  11 march
                </td>
              </tr>
              <tr class="read">
                <td class="hidden-xs">
                  <span><input type="checkbox" class="checkbox-mail"></span>
                </td>
                <td class="hidden-xs">
                  <i class="fa fa-star"></i>
                </td>
                <td class="hidden-xs">
                  Microsoft
                </td>
                <td>
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit
                </td>
                <td>
                </td>
                <td>
                  11 march
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by stacks</p>
  </div>
</div><!-- Page Inner -->
@endsection