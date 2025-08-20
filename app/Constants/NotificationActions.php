<?php

namespace App\Constants;

class NotificationActions
{
    const ORDER_PLACED                            = 'new_order_placed';
    const ORDER_STATUS_UPDATE                     = 'order_status_update';
    const MAKE_PAYMENT_FOR_ORDER                  = 'make_payment_for_order';

    const REFUND_REQUEST                          = 'new_refund_request';
    const REFUND_REQUEST_STATUS_UPDATE            = 'refund_request_status_update';

    const TRANSACTION_REQUEST_STATUS_UPDATE            = 'transaction_request_status_update';

    const WALLET_RECHARGE_REQUEST                 = 'wallet_recharge_request';
    const WALLET_WITHDRAWAL_REQUEST               = 'wallet_withdrawal_request';
    const WALLET_WITHDRAWAL_REQUEST_STATUS_UPDATE = 'wallet_withdrawal_request_status_change';
    const OTP_SENT                                = 'otp_sent';


    // yet to use
    const ORDER_PLACED_MERCHANT                   = 'new_order_placed_for_merchant';
    const WITHDRAWAL_REQUEST                      = 'withdrawal_request';
    const COMPLETED_DELIVERY_BOY_ORDER            = 'completed_delivery_boy_order';
    const MODIFY_DELIVERY_BOY_COMMISSION          = 'modify_delivery_boy_commission';

    const APPROVED_REFUND_REQUEST                 = 'approved_refund_request';
    const DECLINED_REFUND_REQUEST                 = 'declined_refund_request';

    const WALLET_WITHDRAWAL_REQUEST_REJECTED      = 'wallet_withdrawal_request_rejected';

    const INVESTMENT_STATUS_UPDATED               = 'investment_status_updated';
    const FUND_REQUEST_FROM_MERCHANT              = 'fund_request_from_merchant';
    const FUND_REQUEST_SHORTLISTED_BY_ADMIN       = 'fund_request_short_listed_by_admin';
    const ADMIN_REJECTED_MERCHANT_FUND_REQUEST    = 'admin_rejected_merchant_fund_request';
    const INVESTOR_OFFERED_MERCHANT_FUND_REQUEST  = 'investor_offered_merchant_fund_request';
    const INVESTOR_CANCELED_MERCHANT_FUND_REQUEST = 'investor_canceled_merchant_fund_request';
    const ADMIN_APPROVED_FUND_REQUEST             = 'admin_approved_fund_request';
    const ADMIN_DISBURSED_FUND_REQUEST            = 'admin_disbursed_fund_request';

    const NEW_CAMPAIGN_CREATED                    = 'new_campaign_created';
    const CAMPAIGN_EDITED                         = 'campaign_edited';

    const CAMPAIGN_STATUS_UPDATED                 = 'campaign_status_updated';
    const APPROVED_CAMPAIGN_BY_ADMIN              = 'approved_campaign_by_admin';
    const REJECTED_CAMPAIGN_BY_ADMIN              = 'rejected_campaign_by_admin';



    const NEW_TICKET_CREATED                      = 'new_ticket_created';
    const TICKET_REPLY                            = 'ticket_reply';

     const TICKET_REPLY_FROM_ADMIN                 = 'ticket_reply_from_admin';
     const TICKET_REPLY_FROM_USER                  = 'ticket_reply_from_user'; // from all


     const TICKET_REPLY_FROM_MERCHANT              = 'ticket_reply_from_merchant';
     const TICKET_REPLY_FROM_INVESTOR              = 'ticket_reply_from_investor';
     const TICKET_REPLY_FROM_SUPPLIER              = 'ticket_reply_from_supplier';
     const TICKET_REPLY_FROM_CUSTOMER              = 'ticket_reply_from_customer';

    const ADDED_NEW_NEWS_LETTER                   = 'added_new_news_letter';
    const ADDED_NEW_CONTACT_US                    = 'added_new_contact_us_letter';
}
