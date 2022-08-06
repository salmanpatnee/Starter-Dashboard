<template>
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title level">
                <h4 class="d-inline-block">
                    <slot name="title"></slot>
                </h4>
                <div class="text-center">
                    <slot name="header-middle"></slot>
                </div>
                <slot name="header-right"></slot>
            </div>
        </div>
        <div class="panel-body">
            <slot name="before-content"></slot>
            <slot name="before-content-additional"></slot>
            <slot></slot>
            <slot name="footer"></slot>
        </div>
    </div>
</template>