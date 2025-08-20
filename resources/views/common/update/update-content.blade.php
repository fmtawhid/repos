<div class="row mb-3">
    <div class="col-9">
        <div class="alert alert-warning" role="alert">
            <h5 class="alert-heading">
                {{ localize("Be Aware!! Before Update") }}
            </h5>
            <ol class="mb-0 ps-3">
                <li>{{ localize("Please make that you have backup from your server's") }} <strong>{{ localize("files") }}</strong> {{ localize("and") }}
                    <strong>{{ localize("database") }}</strong>
                   {{ localize("before applying the update. Otherwies, we may lose your files if you have custom changes.") }}
                </li>
                <li>{{ localize("Make sure you have") }} <strong>{{ localize("write permission") }}</strong> {{ localize("on your files and folder. To check the
                    files permission,
                    click on") }}
                    <a href="{{ route('admin.systemUpdate.file-permission') }}" target="_blank"
                       class="btn btn-dark btn-sm px-2 py-1">{{ localize("File Permission Check") }}</a>
                </li>
                <li>{{ localize("Make sure you have stable internet connection") }}</li>
                <li>{{ localize("Do not close the tab while the process is running.") }}</li>
            </ol>
        </div>
    </div>
</div>